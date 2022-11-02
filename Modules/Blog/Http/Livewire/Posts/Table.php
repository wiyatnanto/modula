<?php

namespace Modules\Blog\Http\Livewire\Posts;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Modules\Crud\Http\Traits\WithSorting;

use Modules\Blog\Entities\Post;
use Modules\Blog\Entities\Category;
use Modules\Blog\Entities\Tag;

class Table extends Component
{
    use WithPagination, WithFileUploads, WithSorting;

    public $postId,
        $title,
        $content,
        $slug,
        $status,
        $featured_image,
        $caption,
        $published_at,
        $user_id;
    public $category;
    public $tags = [];
    public $categoryOptions = [];
    public $tagOptions = [];

    public $sortField = "id";
    public $sortAsc = true;
    public $search = "";

    public $selectAll = false;
    public $selected = [];

    public $inCreate,
        $inEdit = false;

    protected $paginationTheme = "bootstrap";

    protected $listeners = [
        "clear",
        "delete",
        "bulkDelete",
        "refreshComponent" => '$refresh',
    ];

    public function clear()
    {
        $this->reset();
        $this->resetErrorBag();
        $this->resetValidation();
    }

    public function updatedSelectAll($value)
    {
        if ($value) {
            $posts = Post::where("title", "ILIKE", "%" . $this->search . "%")
                ->orderBy($this->sortField, $this->sortAsc ? "asc" : "desc")
                ->fastPaginate(10);
            foreach ($posts as $item) {
                $this->selected[$item->id] = true;
            }
        } else {
            $this->selected = [];
        }
    }

    public function hydrate()
    {
        $this->emit("select2");
    }

    public function updatedTags()
    {
        $this->emit("refreshComponent");
    }

    public function store()
    {
        $this->validate([
            "title" => "required|string|max:191",
            "content" => "required|string",
        ]);

        $post = new Post();
        $post->title = $this->title;
        $post->content = $this->content;
        $post->status = 1;
        if (gettype($this->featured_image) === "object") {
            $this->featured_image->store("public/blog/posts");
            $post->featured_image =
                "blog/posts/" . $this->featured_image->hashName();
        }
        $post->caption = $this->caption;
        $post->published_at = $this->published_at;
        $post->user_id = \Auth::user()->id;
        $post->save();

        $newTags = [];
        foreach ($this->tags as $tag) {
            $lastTag = Tag::firstOrCreate([
                "name" => $tag,
            ]);
            $newTags[] = $lastTag->id;
        }
        $post->Tags()->sync($newTags);

        $this->emit("toast", ["success", "Posts has been created"]);
        $this->dispatchBrowserEvent("closeModal");
    }

    public function edit($id)
    {
        $post = Post::find($id);
        $this->postId = $id;
        $this->title = $post->title;
        $this->content = $post->content;
        $this->slug = $post->slug;
        $this->featured_image = $post->featured_image;
        $this->caption = $post->caption;
        $this->published_at = $post->published_at;
        $this->tags = $post
            ->Tags()
            ->get()
            ->pluck("name")
            ->toArray();
    }

    public function update()
    {
        $post = Post::find($this->postId);
        $post->title = $this->title;
        $post->content = $this->content;
        $post->status = $this->featured_image || "Draft";
        if (gettype($this->featured_image) === "object") {
            $this->featured_image->store("public/blog/posts");
            $post->featured_image =
                "blog/posts/" . $this->featured_image->hashName();
        }
        $post->caption = $this->caption;
        $post->published_at = $this->published_at;
        $post->update();
        $post->category()->sync($this->category);
        $newTags = [];
        foreach ($this->tags as $tag) {
            $lastTag = Tag::firstOrCreate([
                "name" => $tag,
            ]);
            $newTags[] = $lastTag->id;
        }
        $post->tags()->sync($newTags);
        $this->emit("toast", ["success", "Posts has been updated"]);
        $this->dispatchBrowserEvent("closeModal");
    }

    public function delete($id)
    {
        $post = Post::find($id)->first();
        $post->tags()->delete();
        $post->delete();

        $this->emit("toast", ["success", "Posts has been deleted"]);
        $this->dispatchBrowserEvent("closeModal");
    }

    public function bulkDelete()
    {
        $selected = \Arr::where($this->selected, function ($value, $key) {
            return $value == true;
        });
        $posts = Post::whereIn("id", array_keys($selected))->get();
        if ($posts) {
            $posts->each->delete();
            $this->emit("toast", ["success", "Post has been deleted"]);
            $this->clear();
        }
    }

    public function render()
    {
        $this->categoryOptions = Category::pluck("name", "id")->toArray();
        $this->tagOptions = Tag::pluck("name", "slug")->toArray();

        return view("blog::livewire.posts.table", [
            "pages" => Post::where("title", "ILIKE", "%" . $this->search . "%")
                ->orderBy($this->sortField, $this->sortAsc ? "asc" : "desc")
                ->fastPaginate(10),
        ])->extends("theme::backend.layouts.master");
    }
}
