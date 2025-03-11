<?php

namespace Darvis\Manta\Livewire\Staff;

use Flux\Flux;
use Illuminate\Http\Request;
use Darvis\Manta\Models\Staff;
use Darvis\Manta\Models\StaffLog;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class StaffLogin extends Component
{
    public ?string $email = null;
    public ?string $password = null;
    public bool $remember = false;
    public ?string $redirect = null;

    public function mount(Request $request)
    {
        if (Auth::guard('staff')->check()) {
            return redirect()->intended(route('cms.dashboard'));
        }
        $this->redirect = $request->get('redirect');
    }

    public function login()
    {
        $credentials = $this->validate([
            'email' => 'required|email',
            'password' => 'required',
        ], [
            'required' => 'Het veld :attribute is verplicht.',
            'email' => 'Het veld :attribute moet een geldig e-mailadres zijn.',
        ], [
            'email' => 'e-mailadres',
            'password' => 'wachtwoord',
        ]);

        if (Auth::guard('staff')->attempt($credentials, $this->remember)) {
            session()->regenerate();

            $staff = Auth::guard('staff')->user();

            StaffLog::create([
                'staff_id' => $staff->id,
                'ip' => request()->ip()
            ]);

            $staff->update(['lastLogin' => now()]);

            Flux::toast(variant: 'success', text: 'Je bent ingelogd');

            if ($this->redirect) {
                return redirect()->intended($this->redirect);
            }
            return redirect()->intended(route('cms.dashboard'));
        }

        StaffLog::create([
            'email' => $this->email,
            'ip' => request()->ip()
        ]);

        $this->addError('email', 'Deze gegevens komen niet overeen met onze administratie.');
    }

    public function render()
    {
        return view('manta::livewire.staff.staff-login')->title('Inloggen')->layout('manta::layouts.flux-blanc');
    }
}
