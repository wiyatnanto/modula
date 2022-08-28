<?php
namespace Modules\Crud\Http\Traits;

trait WithSorting
{
    public $sortField = 'id';
    public $sortAsc = true;

    public function sortBy($field)
    {
        if ($this->sortField === $field) {
            $this->sortAsc = !$this->sortAsc;
        } else {
            $this->sortAsc = true;
        }
        $this->sortField = $field;
    }
}
?>
