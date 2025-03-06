<?php

namespace App\Livewire\Manta\User;

use Manta\Models\User;
use Darvis\Manta\Traits\MantaPagerowTrait;

new class extends \Livewire\Volt\Component {
    public User $item;

    use MantaPagerowTrait;
};
?>
<flux:table.row data-id="{{ $item->id }}">
    <flux:table.cell>{{ $item->name }}</flux:table.cell>
    <flux:table.cell>{{ $item->email }}</flux:table.cell>
    <flux:table.cell>{!! $item->active
        ? '<i class="text-green-600 fa-solid fa-check"></i>'
        : '<i class="text-red-600 fa-solid fa-xmark"></i>' !!}</flux:table.cell>
    <x-manta.flux.manta-flux-delete :$item :$route_name :$moduleClass uploads :$fields :translatable="false" />
</flux:table.row>
