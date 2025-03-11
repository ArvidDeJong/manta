<?php

namespace Darvis\Manta\Livewire\Page;

use Livewire\Component;
use Darvis\Manta\Models\Page;
use Darvis\Manta\Traits\SortableTrait;
use Darvis\Manta\Traits\MantaTrait;
use Darvis\Manta\Traits\WithSortingTrait;
use Livewire\WithPagination;

class PageList extends Component
{
    use PageTrait;
    use WithPagination;
    use SortableTrait;
    use MantaTrait;
    use WithSortingTrait;

    public function mount()
    {
        $this->getBreadcrumb();
        $this->sortBy = 'homepageSort';
    }

    public function render()
    {
        $this->trashed = count(Page::whereNull('pid')->onlyTrashed()->get());

        $obj = Page::whereNull('pid');
        if ($this->tablistShow == 'trashed') {
            $obj->onlyTrashed();
        }

        $obj->where('fullpage', '=', 1);

        $obj = $this->applySorting($obj);
        $obj = $this->applySearch($obj);
        $items = $obj->paginate(50);
        return view('manta::livewire.page.page-list', ['items' => $items])->title($this->config['module_name']['multiple']);
    }
}
