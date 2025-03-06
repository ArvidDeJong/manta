<?php

namespace Darvis\Manta\Livewire\User;

use Flux\Flux;
use Darvis\Manta\Models\User;
use Illuminate\Http\Request;
use Livewire\Component;
use Darvis\Manta\Traits\MantaTrait;

class UserUpdate extends Component
{
    use MantaTrait;
    use UserTrait;

    public function mount(Request $request, User $user)
    {
        $this->item = $user;
        $this->id = $user->id;

        $this->fill(
            $user->only(
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
                'comments'
            )
        );

        $this->getLocaleInfo();
        $this->getTablist();
        $this->getBreadcrumb('update');
    }

    public function render()
    {
        return view('livewire.manta.default.manta-default-update')->title($this->config['module_name']['single'] . ' aanpassen');
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
        $row['updated_by'] = auth('staff')->user()->name;
        User::where('id', $this->id)->update($row);
        // $this->toastr('success', 'Gebruiker toegevoegd');

        // return redirect()->to(route('user.list'));
        Flux::toast('Opgeslagen', duration: 1000, variant: 'success');
    }
}
