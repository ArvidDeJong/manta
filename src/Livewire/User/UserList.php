<?php

namespace Darvis\Manta\Livewire\User;

use Darvis\Manta\Models\User;
use Livewire\Component;
use Darvis\Manta\Traits\SortableTrait;
use Darvis\Manta\Traits\MantaTrait;
use Darvis\Manta\Traits\WithSortingTrait;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Livewire\WithPagination;

class UserList extends Component
{
    use UserTrait;
    use WithPagination;
    use SortableTrait;
    use MantaTrait;
    use WithSortingTrait;

    public function mount()
    {
        $this->getBreadcrumb();
    }

    public function render()
    {
        $this->trashed = count(User::whereNull('pid')->onlyTrashed()->get());

        $obj = User::whereNull('pid');
        if ($this->tablistShow == 'trashed') {
            $obj->onlyTrashed();
        }
        $obj = $this->applySorting($obj);
        $obj = $this->applySearch($obj);
        $items = $obj->paginate(50);
        return view('manta::livewire.user.user-list', ['items' => $items])->title('Klanten');
    }
}
