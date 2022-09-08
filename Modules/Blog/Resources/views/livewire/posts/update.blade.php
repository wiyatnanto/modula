<x-crud::organisms.modal size="xl" preventSubmit="update({{ $postId }})" submitLabel="Update" id="updatePost"
    title="Update Page">
    <x-crud::molecules.tabs active="content">
        <x-crud::molecules.tab title="Content" name="content">
            <div class="mt-3">
                <div class="mb-3">
                    <label for="title" class="form-label">Title</label>
                    <x-crud::atoms.input type="text" placeholder="Title" name="title" wire:model="title" />
                    @error('title')
                        <label id="title-error" class="error invalid-feedback" for="title">{{ $message }}</label>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="content" class="form-label">Content</label>
                    <x-crud::atoms.froala-editor placeholder="Title" name="content" wire:model="content" />
                    @error('content')
                        <label id="content-error" class="error invalid-feedback" for="content">{{ $message }}</label>
                    @enderror
                </div>
                <div class="row">
                    <div class="col-sm-4">
                        <div class="mb-3">
                            <label for="category" class="form-label">Category</label>
                            <x-crud::atoms.select2 name="category" wire:model="category" dropdownParent="updatePost">
                                @foreach ($categoryOptions as $key => $category)
                                    <option value="{{ $key }}">{{ $category }}</option>
                                @endforeach
                            </x-crud::atoms.select2>
                            @error('category')
                                <label id="category-error" class="error invalid-feedback"
                                    for="category">{{ $message }}</label>
                            @enderror
                        </div>
                    </div>
                    <div class="col-sm-8">
                        <div class="mb-3">
                            <label for="tags" class="form-label">Tags</label>
                            {{ json_encode($tags) }}

                            <x-crud::atoms.select2 tags="true" dropdownParent="updatePost" closeOnSelect="false"
                                wire:model.defer="tags" multiple="multiple">
                                @foreach ($tagOptions as $key => $tag)
                                    <option value="{{ $tag }}"
                                        @if (in_array($tag, $tags)) selected @endif">
                                        {{ $tag }}</option>
                                @endforeach
                            </x-crud::atoms.select2>
                            @error('tags')
                                <label id="tags-error" class="error invalid-feedback"
                                    for="tags">{{ $message }}</label>
                            @enderror
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="mb-3">
                            <label for="published_at" class="form-label">Publish At {{ $published_at }}</label>
                            <x-crud::atoms.flatpickr placeholder="Publish at" name="published_at"
                                wire:model="published_at" />
                            @error('published_at')
                                <label id="published_at-error" class="error invalid-feedback"
                                    for="published_at">{{ $message }}</label>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
        </x-crud::molecules.tab>
        <x-crud::molecules.tab title="Image" name="image">
            <div class="mt-3">
                <div class="mb-3">
                    <label for="featured_image" class="form-label">Featured Image</label>
                    <x-crud::atoms.filepond placeholder="Background Image" name="featured_image"
                        wire:model="featured_image" />
                    @error('featured_image')
                        <label id="featured_image-error" class="error invalid-feedback"
                            for="featured_image">{{ $message }}</label>
                    @enderror
                </div>
            </div>
        </x-crud::molecules.tab>
        <x-crud::molecules.tab title="Meta" name="meta">
            <div class="mt-3">
                <div class="mb-3">
                    <label for="meta" class="form-label">Meta</label>
                    <x-crud::atoms.textarea placeholder="meta, meta, ..." name="meta" wire:model="meta" />
                    @error('meta')
                        <label id="meta-error" class="error invalid-feedback" for="meta">{{ $message }}</label>
                    @enderror
                </div>
            </div>
        </x-crud::molecules.tab>
    </x-crud::molecules.tabs>
</x-crud::organisms.modal>
