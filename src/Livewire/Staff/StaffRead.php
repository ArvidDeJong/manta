<?php

namespace Darvis\Manta\Livewire\Staff;

use App\Models\Staff;
use Darvis\Manta\Traits\MantaTrait;
use Illuminate\Http\Request;
use Livewire\Component;

class StaffRead extends Component
{
    use MantaTrait;
    use StaffTrait;

    public function mount(Request $request, Staff $staff)
    {
        $this->item = $staff;
        $this->itemOrg = $staff;
        $this->locale = $staff->locale;

        if ($staff) {
            $this->id = $staff->id;
        }
        // $this->getLocaleInfo();
        $this->getBreadcrumb('read');
        // $this->getTablist();
    }

    public function render()
    {
        return view('manta::livewire.staff.staff-read')->title($this->config['module_name']['single'] . ' bekijken');
    }
}
