<?php

namespace Darvis\Manta\Livewire\Routeseo;

use Livewire\Component;
use Darvis\Manta\Traits\TableRowTrait;

class RouteseoListRow extends Component
{
    use RouteseoTrait;
    use TableRowTrait;

    public $tablekey;

    public function render()
    {
        return view('manta::livewire.routeseo.routeseo-list-row');
    }
}
