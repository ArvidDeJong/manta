<?php

namespace Darvis\Manta\Livewire\Staff;

use Livewire\Component;
use Darvis\Manta\Traits\TableRowTrait;

class StaffListRow extends Component
{
    use StaffTrait;
    use TableRowTrait;
    
    public int $tablekey;

    public function render()
    {
        return view('manta::livewire.staff.staff-list-row');
    }
}
