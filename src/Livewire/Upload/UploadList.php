<?php

namespace Darvis\Manta\Livewire\Upload;

use Livewire\Component;
use Darvis\Manta\Models\Upload;
use Darvis\Manta\Traits\SortableTrait;
use Darvis\Manta\Traits\MantaTrait;
use Darvis\Manta\Traits\WithSortingTrait;
use Livewire\WithPagination;

class UploadList extends Component
{
    use WithPagination;
    use SortableTrait;
    use MantaTrait;
    use WithSortingTrait;
    use UploadTrait;

    public function mount()
    {
        $this->getBreadcrumb();
        $this->sortBy = 'created_at';
        $this->sortDirection = 'DESC';
    }

    public function render()
    {
        $this->trashed = count(Upload::whereNull('pid')->onlyTrashed()->get());

        $obj = Upload::query();
        $obj = $this->applySorting($obj);
        $obj = $this->applySearch($obj);
        if ($this->tablistShow == 'trashed') {
            $obj->onlyTrashed();
        }
        $items = $obj->paginate(20);

        return view('livewire.manta.upload.upload-list', compact('items'))->title('Uploads');
    }
}
