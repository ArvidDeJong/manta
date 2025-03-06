<?php

use App\Http\Controllers\MailtrapWebhookController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Livewire\Livewire;
use Illuminate\Support\Facades\Artisan;
use App\Livewire\Manta\Staff\StaffLogin;
use App\Livewire\Manta\Staff\StaffPasswordForgot;
use App\Livewire\Manta\Staff\StaffPasswordReset;
use Illuminate\Auth\Access\AuthorizationException;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Verified;


// php artisan vb:ai:translate



//Laravel File Manager routes with middleware
Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['auth:staff']], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});


// Clear settings
Route::get('/clearDgP', function () {
    Artisan::call('cache:clear'); // Cache legen
    Artisan::call('route:clear'); // Routes cache legen
    Artisan::call('config:clear'); // Config cache legen
    Artisan::call('view:clear'); // Views cache legen
    Artisan::call('storage:link', []); // Symlink voor storage aanmaken
    Artisan::call('event:clear'); // Events cache legen
    Artisan::call('optimize:clear'); // Optimalisatie caches legen
    return response()->json([
        'status' => 'success',
        'message' => 'Alle caches en links zijn succesvol geleegd en opnieuw aangemaakt.',
    ]);
});
Livewire::setUpdateRoute(function ($handle) {
    return Route::post('/livewire/update', $handle);
});

// Prevent register route
Route::fallback(function () {
    return abort(404);
})->where('path', 'register');

// User & Staff login routes
Route::prefix('staff')->group(function () {
    Route::get('/login', StaffLogin::class)->name('staff.login');
    Route::get('/wachtwoord-vergeten', StaffPasswordForgot::class)->name('staff.password.request');
    Route::get('/wachtwoord-reset/{token}', StaffPasswordReset::class)->name('staff.password.reset');
});

// Logout route
Route::get('/logout', function () {
    // if (Auth::check()) {
    Auth::logout();
    Auth::guard('web')->logout();
    Auth::guard('staff')->logout();
    sleep(1); // Consider re-evaluating the necessity of this sleep
    // }

    return redirect('/');
})->name('users.logout');



Route::get('/email/verify/{id}/{hash}', function (Request $request, $id, $hash) {
    $user = User::findOrFail($id);

    // Verifieer of de hash overeenkomt
    if (!hash_equals($hash, sha1($user->getEmailForVerification()))) {
        throw new AuthorizationException();
    }

    // Verifieer of de gebruiker al geverifieerd is
    if ($user->hasVerifiedEmail()) {
        return redirect(route('login'))->with('status', __('compri.email-already-verified'));
    }

    // Markeer de e-mail als geverifieerd
    $user->markEmailAsVerified();

    // Trigger het verified event
    event(new Verified($user));

    // Optioneel: log de gebruiker in
    Auth::login($user);

    return redirect(route('login'))->with('status', __('compri.email-verified'));
})->name('verification.verify');
