<?php

namespace Darvis\Manta\Livewire\Mailtrap;

use Darvis\Manta\Models\Mailtrap;
use Livewire\Component;
use Livewire\WithPagination;
use Darvis\Manta\Traits\MantaTrait;
use Darvis\Manta\Traits\SortableTrait;
use Darvis\Manta\Traits\WithSortingTrait;

class MailtrapList extends Component
{
    use MailtrapTrait;
    use WithPagination;
    use SortableTrait;
    use MantaTrait;
    use WithSortingTrait;

    public function mount()
    {
        $this->sortBy = 'created_at';
        $this->sortDirection = 'DESC';
        $this->getBreadcrumb();
    }

    public function render()
    {
        $this->trashed = null; //count(Mailtrap::whereNull('pid')->onlyTrashed()->get());

        $obj = Mailtrap::query();
        if ($this->tablistShow == 'trashed') {
            $obj->onlyTrashed();
        }
        $obj = $this->applySorting($obj);
        $obj = $this->applySearch($obj);
        $items = $obj->paginate(50);
        return view('livewire.manta.mailtrap.mailtrap-list', ['items' => $items])->title($this->config['module_name']['multiple']);
    }
}
