<?php

namespace Darvis\Manta\Livewire\Staff;

use Darvis\Manta\Models\Staff;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Darvis\Manta\Traits\MantaTrait;
use Faker\Factory as Faker;
use Illuminate\Support\Str;

class StaffCreate extends Component
{
    use MantaTrait;
    use StaffTrait;

    public function mount()
    {
        $this->password = generatePassword();

        if (class_exists(Faker::class) && env('APP_ENV') == 'local') {
            $faker = Faker::create('NL_nl');
            $this->password = Str::password(12, true, true, true, true); // $faker->password();
        }
        $this->getBreadcrumb('create');
    }

    public function render()
    {
        return view('manta::livewire.staff.staff-create')->title($this->config['module_name']['single'] . ' toevoegen');
    }


    public function save()
    {
        $this->validate();

        $row = $this->only(
            'company_id',
            'host',
            'pid',
            'locale',
            'active',
            'name',
            'email',
            'phone',
            'password',
            'admin',
            'developer',
            'comments',
        );
        $row['created_by'] = auth('staff')->user()->name;
        $row['host'] = request()->host();
        $row['password'] = Hash::make($this->password);
        $row['code'] = Hash::make(time());
        Staff::create($row);

        return $this->redirect(StaffList::class);
    }
}
