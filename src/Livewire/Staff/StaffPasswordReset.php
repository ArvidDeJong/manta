<?php

namespace Darvis\Manta\Livewire\Staff;

use Livewire\Component;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Str;

class StaffPasswordReset extends Component
{
    public $token;
    public $email;
    public $password;
    public $password_confirmation;

    protected $rules = [
        'email' => 'required|email',
        'password' => 'required|min:8|confirmed',
    ];

    public function mount($token)
    {
        $this->token = $token;
    }

    public function resetPassword()
    {
        $this->validate();

        $response = Password::broker('staff')->reset(
            [
                'email' => $this->email,
                'token' => $this->token,
                'password' => $this->password,
            ],
            function ($user, $password) {
                $user->forceFill([
                    'password' => bcrypt($password)
                ])->save();

                $user->setRememberToken(Str::random(60));

                event(new PasswordReset($user));
            }
        );

        if ($response == Password::PASSWORD_RESET) {
            return redirect()->route('staff.login')->with('status', __($response));
        } else {
            $this->addError('email', __($response));
        }
    }

    public function render()
    {
        return view('manta::livewire.staff.staff-password-reset')->title('Wachtwoord reset')->layout('manta::layouts.flux-blanc');
    }
}
