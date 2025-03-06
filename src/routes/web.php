<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Auth\Access\AuthorizationException;
use App\Models\User;
use Darvis\Manta\Livewire\Staff\StaffLogin;
use Darvis\Manta\Livewire\Staff\StaffPasswordForgot;
use Darvis\Manta\Livewire\Staff\StaffPasswordReset;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Verified;
use Illuminate\Support\Facades\Session;

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

Route::group(['prefix' => 'cms', 'middleware' => ['auth:staff', 'web']], function () {

    $modules = collect(cms_config('manta')['modules']);

    Route::get("/dashboard", env('CMS_DASHBOARD', 'Darvis\Manta\Livewire\Page\PageList'))->name('cms.dashboard');
    Route::get("/sandbox", Darvis\Manta\Livewire\Cms\CmsSandbox::class)->name('cms.sandbox');
    Route::get("/numbers", Darvis\Manta\Livewire\Cms\CmsNumbers::class)->name('cms.numbers');
    Route::get("/module/vertalingen", Darvis\Manta\Livewire\Cms\CmsModuleTranslations::class)->name('cms.module.translations');
    Route::get("/instellingen", Darvis\Manta\Livewire\Option\OptionUpdate::class)->name('cms.options');
    Route::get("/talen/update", Darvis\Manta\Livewire\Translator\TranslatorUpdate::class)->name('translator.update');
    Route::get("/chatgpt/chat", Darvis\Manta\Livewire\Chatgpt\ChatgptChat::class)->name('chatgpt.chat');
    Route::get("/talen", Darvis\Manta\Livewire\Translator\TranslatorList::class)->name('translator.list');

    $agendaModule = $modules->firstWhere("name", 'mailtrap');
    if ($agendaModule && $agendaModule['active']) {
        Route::get("/{$agendaModule['routename']}", Darvis\Manta\Livewire\Mailtrap\MailtrapList::class)->name('mailtrap.list');
    }

    $agendaModule = $modules->firstWhere("name", 'page');
    if ($agendaModule && $agendaModule['active']) {
        Route::get("/{$agendaModule['routename']}", Darvis\Manta\Livewire\Page\PageList::class)->name('page.list');
        Route::get("/{$agendaModule['routename']}/toevoegen", Darvis\Manta\Livewire\Page\PageCreate::class)->name('page.create');
        Route::get("/{$agendaModule['routename']}/aanpassen/{page}", Darvis\Manta\Livewire\Page\PageUpdate::class)->name('page.update');
        Route::get("/{$agendaModule['routename']}/lezen/{page}", Darvis\Manta\Livewire\Page\PageRead::class)->name('page.read');
        Route::get("/{$agendaModule['routename']}/bestanden/{page}", Darvis\Manta\Livewire\Page\PageUpload::class)->name('page.upload');
    }

    $agendaModule = $modules->firstWhere("name", 'staff');
    if ($agendaModule && $agendaModule['active']) {
        Route::get("/{$agendaModule['routename']}", Darvis\Manta\Livewire\Staff\StaffList::class)->name('staff.list');
        Route::get("/{$agendaModule['routename']}/toevoegen", Darvis\Manta\Livewire\Staff\StaffCreate::class)->name('staff.create');
        Route::get("/{$agendaModule['routename']}/aanpassen/{staff}", Darvis\Manta\Livewire\Staff\StaffUpdate::class)->name('staff.update');
        Route::get("/{$agendaModule['routename']}/lezen/{staff}", Darvis\Manta\Livewire\Staff\StaffRead::class)->name('staff.read');
    }

    $agendaModule = $modules->firstWhere("name", 'routeseo');
    if ($agendaModule && $agendaModule['active']) {
        Route::get("/{$agendaModule['routename']}", Darvis\Manta\Livewire\Routeseo\RouteseoList::class)->name('routeseo.list');
        Route::get("/{$agendaModule['routename']}/toevoegen", Darvis\Manta\Livewire\Routeseo\RouteseoCreate::class)->name('routeseo.create');
        Route::get("/{$agendaModule['routename']}/aanpassen/{routeseo}", Darvis\Manta\Livewire\Routeseo\RouteseoUpdate::class)->name('routeseo.update');
        Route::get("/{$agendaModule['routename']}/lezen/{routeseo}", Darvis\Manta\Livewire\Routeseo\RouteseoRead::class)->name('routeseo.read');
        Route::get("/{$agendaModule['routename']}/bestanden/{routeseo}", Darvis\Manta\Livewire\Routeseo\RouteseoUpload::class)->name('routeseo.upload');
    }

    $moduleConfig = $modules->firstWhere("name", 'upload');
    if ($moduleConfig && $moduleConfig['active']) {
        Route::get("/{$moduleConfig['routename']}", Darvis\Manta\Livewire\Upload\UploadList::class)->name('upload.list');
        Route::get("/{$moduleConfig['routename']}/toevoegen", Darvis\Manta\Livewire\Upload\UploadCreate::class)->name('upload.create');
        Route::get("/{$moduleConfig['routename']}/dropzone", Darvis\Manta\Livewire\Upload\UploadDropzone::class)->name('upload.dropzone');
        Route::get("/{$moduleConfig['routename']}/aanpassen/{upload}", Darvis\Manta\Livewire\Upload\UploadUpdate::class)->name('upload.update');
        Route::get("/{$moduleConfig['routename']}/lezen/{upload}", Darvis\Manta\Livewire\Upload\UploadRead::class)->name('upload.read');
        Route::get("/{$moduleConfig['routename']}/crop/{upload}", Darvis\Manta\Livewire\Upload\UploadCrop::class)->name('upload.crop');
    }

    $agendaModule = $modules->firstWhere("name", 'user');
    if ($agendaModule && $agendaModule['active']) {
        Route::get("/{$agendaModule['routename']}", Darvis\Manta\Livewire\User\UserList::class)->name('user.list');
        Route::get("/{$agendaModule['routename']}/toevoegen", Darvis\Manta\Livewire\User\UserCreate::class)->name('user.create');
        Route::get("/{$agendaModule['routename']}/aanpassen/{user}", Darvis\Manta\Livewire\User\UserUpdate::class)->name('user.update');
        Route::get("/{$agendaModule['routename']}/lezen/{user}", Darvis\Manta\Livewire\User\UserRead::class)->name('user.read');
    }
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
    if (Auth::check()) {
        $guard = Auth::getDefaultDriver(); // Haalt de actieve guard op
        Auth::guard($guard)->logout();
    }
    Session::invalidate(); // Ongeldig maken van de sessie
    Session::regenerateToken(); // Nieuwe CSRF-token genereren

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
        return redirect(route('login'))->with('status', __('manta::auth.email-already-verified'));
    }

    // Markeer de e-mail als geverifieerd
    $user->markEmailAsVerified();

    // Trigger het verified event
    event(new Verified($user));

    // Optioneel: log de gebruiker in
    Auth::login($user);

    return redirect(route('login'))->with('status', __('manta::auth.email-verified'));
})->name('verification.verify');
