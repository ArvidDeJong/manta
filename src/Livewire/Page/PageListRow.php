<?php

namespace Darvis\Manta\Livewire\Page;

use Livewire\Component;
use Darvis\Manta\Traits\TableRowTrait;

class PageListRow extends Component
{
    use PageTrait;
    use TableRowTrait;

    public function render()
    {
        return view('manta::livewire.page.page-list-row');
    }
}
