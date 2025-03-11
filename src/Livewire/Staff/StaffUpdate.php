<?php

namespace Darvis\Manta\Livewire\Staff;

use Flux\Flux;
use Livewire\Component;
use App\Models\Staff;
use Darvis\Manta\Traits\MantaTrait;
use Illuminate\Support\Facades\Hash;

class StaffUpdate extends Component
{
    use StaffTrait;
    use MantaTrait;

    public function mount(Staff $staff)
    {
        $this->item = $staff;
        $this->itemOrg = $staff;

        $this->id = $staff->id;
        $this->fill(
            $staff->only(
                'company_id',
                'host',
                'pid',
                'locale',
                'active',
                'name',
                'email',
                'phone',
                'admin',
                'developer',
                'comments',
            ),
        );


        // $this->getLocaleInfo();
        $this->getBreadcrumb('update');
        $this->getTablist();
    }


    public function render()
    {
        return view('manta::livewire.staff.staff-update')->title($this->config['module_name']['single'] . ' aanpassen');
    }



    public function save()
    {
        $this->validate();

        $input = $this->only(
            'company_id',
            'host',
            'pid',
            'locale',
            'active',
            'name',
            'email',
            'phone',
            'admin',
            'developer',
            'comments',
        );
        if ($this->password) {
            $input['password'] = Hash::make($this->password);
        }
        // $input['updated_by'] = auth()->name;

        $item = Staff::find($this->id);
        $item->update($input);

        // return redirect()->to(route($this->route_name . '.list'));
        Flux::toast('Opgeslagen', duration: 1000, variant: 'success');
    }
}
