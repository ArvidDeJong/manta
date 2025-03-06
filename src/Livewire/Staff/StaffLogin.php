<?php

namespace Darvis\Manta\Livewire\Staff;

use Flux\Flux;
use Illuminate\Http\Request;
use Darvis\Manta\Models\Staff;
use Darvis\Manta\Models\StaffLog;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\Attributes\Locked;

class StaffLogin extends Component
{
    use StaffTrait;
    public ?string $email = null;
    public ?string $password = null;
    public bool $remember = false;

    #[Locked]
    public $redirect;

    public function mount(Request $request)
    {

        if ($request->input('redirect')) {
            $this->redirect = $request->input('redirect');
        }
    }

    public function login()
    {
        $this->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ], [
            'required' => 'Het veld :attribute is verplicht.',
            'email' => 'Het veld :attribute moet een geldig e-mailadres zijn.',
            'attributes' => [
                'email' => 'e-mailadres',
                'password' => 'wachtwoord',
            ],
        ]);

        if (Auth::guard('staff')->attempt(['email' => $this->email, 'password' => $this->password], $this->remember)) {
            $staff = Staff::where('email', $this->email)->first();

            StaffLog::create([
                'staff_id' => $staff->id,
                'ip' => request()->ip()
            ]);

            $staff->update(['lastLogin' => now()]);

            if ($this->redirect) {
                return redirect()->intended($this->redirect);
            } else {
                return redirect()->intended(route('cms.dashboard'));
            }
        } else {
            StaffLog::create([
                'email' => $this->email,
                'ip' => request()->ip()
            ]);

            Flux::toast(variant: 'danger', text: 'Je inloggegevens zijn niet correct');
            return back()->withErrors([
                'email' => 'De combinatie van e-mailadres en wachtwoord is niet correct.',
            ]);
        }
    }

    public function render()
    {
        return view('manta::livewire.staff.staff-login')->title('Inloggen')->layout('manta::layouts.flux-blanc');
    }
}
