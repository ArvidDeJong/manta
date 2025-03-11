<?php

use Illuminate\Support\Facades\Route;
//
Route::group(['prefix' => 'cms', 'middleware' => ['auth:staff', 'web']], function () {

    $modules = collect(cms_config('manta')['modules']);

    Route::get("/dashboard", Darvis\Manta\Livewire\Page\PageList::class)->name('cms.dashboard');
    Route::get("/sandbox", Darvis\Manta\Livewire\Cms\CmsSandbox::class)->name('cms.sandbox');
    Route::get("/numbers", Darvis\Manta\Livewire\Cms\CmsNumbers::class)->name('cms.numbers');
    Route::get("/module/vertalingen", Darvis\Manta\Livewire\Cms\CmsModuleTranslations::class)->name('cms.module.translations');
    Route::get("/instellingen", Darvis\Manta\Livewire\Option\OptionUpdate::class)->name('cms.options');
    Route::get("/talen/update", Darvis\Manta\Livewire\Translator\TranslatorUpdate::class)->name('translator.update');
    Route::get("/chatgpt/chat", Darvis\Manta\Livewire\Chatgpt\ChatgptChat::class)->name('chatgpt.chat');
    Route::get("/talen", Darvis\Manta\Livewire\Translator\TranslatorList::class)->name('translator.list');

    $agendaModule = $modules->firstWhere("name", 'mailtrap');
    $name = isset($moduleConfig['routename']) ? $moduleConfig['routename'] : 'mailtrap';
    Route::get("/{$name}", Darvis\Manta\Livewire\Mailtrap\MailtrapList::class)->name('mailtrap.list');


    $agendaModule = $modules->firstWhere("name", 'page');
    $name = isset($moduleConfig['routename']) ? $moduleConfig['routename'] : 'page';
    Route::get("/{$name}", Darvis\Manta\Livewire\Page\PageList::class)->name('page.list');
    Route::get("/{$name}/toevoegen", Darvis\Manta\Livewire\Page\PageCreate::class)->name('page.create');
    Route::get("/{$name}/aanpassen/{page}", Darvis\Manta\Livewire\Page\PageUpdate::class)->name('page.update');
    Route::get("/{$name}/lezen/{page}", Darvis\Manta\Livewire\Page\PageRead::class)->name('page.read');
    Route::get("/{$name}/bestanden/{page}", Darvis\Manta\Livewire\Page\PageUpload::class)->name('page.upload');


    $agendaModule = $modules->firstWhere("name", 'staff');
    $name = isset($moduleConfig['routename']) ? $moduleConfig['routename'] : 'staff';
    Route::get("/{$name}", Darvis\Manta\Livewire\Staff\StaffList::class)->name('staff.list');
    Route::get("/{$name}/toevoegen", Darvis\Manta\Livewire\Staff\StaffCreate::class)->name('staff.create');
    Route::get("/{$name}/aanpassen/{staff}", Darvis\Manta\Livewire\Staff\StaffUpdate::class)->name('staff.update');
    Route::get("/{$name}/lezen/{staff}", Darvis\Manta\Livewire\Staff\StaffRead::class)->name('staff.read');


    $agendaModule = $modules->firstWhere("name", 'routeseo');
    $name = isset($moduleConfig['routename']) ? $moduleConfig['routename'] : 'routeseo';
    Route::get("/{$name}", Darvis\Manta\Livewire\Routeseo\RouteseoList::class)->name('routeseo.list');
    Route::get("/{$name}/toevoegen", Darvis\Manta\Livewire\Routeseo\RouteseoCreate::class)->name('routeseo.create');
    Route::get("/{$name}/aanpassen/{routeseo}", Darvis\Manta\Livewire\Routeseo\RouteseoUpdate::class)->name('routeseo.update');
    Route::get("/{$name}/lezen/{routeseo}", Darvis\Manta\Livewire\Routeseo\RouteseoRead::class)->name('routeseo.read');
    Route::get("/{$name}/bestanden/{routeseo}", Darvis\Manta\Livewire\Routeseo\RouteseoUpload::class)->name('routeseo.upload');


    $moduleConfig = $modules->firstWhere("name", 'upload');
    $name = isset($moduleConfig['routename']) ? $moduleConfig['routename'] : 'upload';
    Route::get("/{$name}", Darvis\Manta\Livewire\Upload\UploadList::class)->name('upload.list');
    Route::get("/{$name}/toevoegen", Darvis\Manta\Livewire\Upload\UploadCreate::class)->name('upload.create');
    Route::get("/{$name}/dropzone", Darvis\Manta\Livewire\Upload\UploadDropzone::class)->name('upload.dropzone');
    Route::get("/{$name}/aanpassen/{upload}", Darvis\Manta\Livewire\Upload\UploadUpdate::class)->name('upload.update');
    Route::get("/{$name}/lezen/{upload}", Darvis\Manta\Livewire\Upload\UploadRead::class)->name('upload.read');
    Route::get("/{$name}/crop/{upload}", Darvis\Manta\Livewire\Upload\UploadCrop::class)->name('upload.crop');


    $agendaModule = $modules->firstWhere("name", 'user');
    $name = isset($moduleConfig['routename']) ? $moduleConfig['routename'] : 'user';
    Route::get("/{$name}", Darvis\Manta\Livewire\User\UserList::class)->name('user.list');
    Route::get("/{$name}/toevoegen", Darvis\Manta\Livewire\User\UserCreate::class)->name('user.create');
    Route::get("/{$name}/aanpassen/{user}", Darvis\Manta\Livewire\User\UserUpdate::class)->name('user.update');
    Route::get("/{$agendaModule['routename']}/lezen/{user}", Darvis\Manta\Livewire\User\UserRead::class)->name('user.read');
});
