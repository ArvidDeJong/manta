<?php

namespace Darvis\Manta\Livewire\Staff;

use Flux\Flux;
use Illuminate\Http\Request;
use App\Models\Staff;
use App\Models\StaffLog;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\Attributes\Locked;

class StaffLogin extends Component
{

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

        $credentials = $this->validate([
            'email' => 'required|email',
            'password' => 'required',
        ], [
            'required' => 'Het veld :attribute is verplicht.',
            'email' => 'Het veld :attribute moet een geldig e-mailadres zijn.',
            'attributes' => [
                'email' => 'e-mailadres',
                'password' => 'wachtwoord',
            ],
        ]);

        if (Auth::guard('staff')->attempt($credentials)) {
            session()->regenerate();

            session()->put('user_id', Auth::guard('staff')->id());

            // dd([
            //     'session_user_id' => session('user_id'),
            //     'auth_guard_id' => Auth::guard('staff')->id(),
            //     'auth_user' => Auth::guard('staff')->user(),
            //     'session_data' => session()->all(),
            // ]);

            $staff = Auth::guard('staff')->user(); // Haal de ingelogde gebruiker op

            // 🔍 Controleer of de user correct is ingesteld
            if (!$staff) {
                dd('User is not set in the session.');
            }

            // 🔥 Forceer de gebruiker ID via Auth::id()
            $staff_id = Auth::guard('staff')->id();

            StaffLog::create([
                'staff_id' => $staff_id, // Forceer de ID hier
                'ip' => request()->ip()
            ]);

            $staff->update(['lastLogin' => now()]);

            // session()->regenerate(); // Forceer sessie vernieuwing

            // dd([
            //     'session' => session()->all(),
            //     'auth_staff_user' => Auth::guard('staff')->user(),
            // ]);
            // $staff = Staff::where('email', $this->email)->first();

            // StaffLog::create([
            //     'staff_id' => $staff->id,
            //     'ip' => request()->ip()
            // ]);

            // $staff->update(['lastLogin' => now()]);

            // if ($this->redirect) {
            //     return redirect()->intended($this->redirect);
            // } else {
            //     return redirect()->intended(route('cms.dashboard'));
            // }
            dd(Auth::guard('staff')->user());
            return redirect()->intended(route('cms.dashboard'));
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
