<?php

namespace Darvis\Manta\Livewire\Staff;

use Livewire\Component;
use Illuminate\Support\Facades\Password;


class StaffPasswordForgot extends Component
{
    public $email;

    public $status;

    public function sendResetLink()
    {
        $this->validate(['email' => 'required|email']);

        $response = Password::broker('staff')->sendResetLink(
            ['email' => $this->email]
        );

        $this->status = $response == Password::RESET_LINK_SENT
            ? 'We hebben uw link voor wachtwoordherstel verzonden!'
            : 'Er is een fout opgetreden tijdens het verzenden van de wachtwoordherstellink.';
    }


    public function render()
    {
        return view('manta::livewire.staff.staff-password-forgot')->title('Wachtwoord vergeten')->layout('manta::layouts.flux-blanc');
    }
}
