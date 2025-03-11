<?php


require  'basics.php';
require  'modules.php';

Livewire::setUpdateRoute(function ($handle) {
    return Route::post('/manta/livewire/update', $handle);
});
