<?php

namespace Darvis\Manta\Traits;

use Livewire\Attributes\Url;

trait WithSortingTrait
{

    protected function applySorting($query)
    {
        if ($this->sortBy) {
            $query->orderBy($this->sortBy, $this->sortDirection);
        }

        return $query;
    }

    #[Url]
    public $sortBy;

    #[Url]
    public $sortDirection = 'asc';

    public function dosort($column)
    {

        if ($this->sortBy === $column) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortBy = $column;
            $this->sortDirection = 'asc';
        }
    }
}
