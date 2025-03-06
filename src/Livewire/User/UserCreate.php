<?php

namespace Darvis\Manta\Livewire\User;

use Darvis\Manta\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Darvis\Manta\Traits\MantaTrait;

class UserCreate extends Component
{
    use MantaTrait;
    use UserTrait;

    public function mount(Request $request)
    {
        $this->locale = getLocaleManta();
        if ($request->input('locale') && $request->input('pid')) {
            $user = User::find($request->input('pid'));
            $this->pid = $user->id;
            $this->locale = $request->input('locale');
            $this->itemOrg = $user;
        }

        $this->getLocaleInfo();
        $this->getTablist();
        $this->getBreadcrumb('create');
    }

    public function render()
    {
        return view('livewire.manta.default.manta-default-create')->title($this->config['module_name']['single'] . ' toevoegen');
    }

    public function save()
    {

        $this->validate();

        $row = $this->only(
            'name',
            'email',
            'company_id',
            'host',
            'locale',
            'sex',
            'initials',
            'lastname',
            'firstnames',
            'nameInsertion',
            'company',
            'companyNr',
            'taxNr',
            'address',
            'housenumber',
            'addressSuffix',
            'zipcode',
            'city',
            'country',
            'state',
            'birthdate',
            'birthcity',
            'phone',
            'phone2',
            'bsn',
            'iban',
            'maritalStatus',
            'comments',
        );
        $row['password'] = Hash::make($this->password);
        $row['created_by'] = auth('staff')->user()->name;
        User::create($row);
        // $this->toastr('success', 'Gebruiker toegevoegd');

        return $this->redirect(UserList::class);
    }
}
