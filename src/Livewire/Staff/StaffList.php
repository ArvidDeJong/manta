<?php

namespace Darvis\Manta\Livewire\Staff;

use Darvis\Manta\Models\Staff;
use Darvis\Manta\Traits\MantaTrait;
use Darvis\Manta\Traits\SortableTrait;
use Darvis\Manta\Traits\WithSortingTrait;
use Livewire\Component;
use Livewire\WithPagination;

class StaffList extends Component
{
    use WithPagination;
    use SortableTrait;
    use WithSortingTrait;
    use MantaTrait;
    use StaffTrait;

    public function mount()
    {
        $this->getBreadcrumb();
        $this->sortBy = 'name';
    }

    public function render()
    {
        $this->trashed = count(Staff::whereNull('pid')->onlyTrashed()->get());

        $obj = Staff::whereNull('pid');
        if ($this->tablistShow == 'trashed') {
            $obj->onlyTrashed();
        }
        $obj = $this->applySorting($obj);
        $obj = $this->applySearch($obj);
        $items = $obj->paginate(50);
        return view('manta::livewire.staff.staff-list', ['items' => $items])->title($this->config['module_name']['multiple']);
    }
}
