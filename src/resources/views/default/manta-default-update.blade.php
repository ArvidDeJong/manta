<flux:main container>
    <x-manta.breadcrumb :$breadcrumb />

    @include('manta::default.manta-default-tabs', [
        'tabs' => $tablistModule,
        'tablistShow' => $tablistModuleShow,
    ])

    <div class="mb-8"></div>
    @if (isset($fields['locale']['active']) &&
            $fields['locale']['active'] &&
            env('SUPPORTED_LOCALES') &&
            count(explode(',', env('SUPPORTED_LOCALES'))) > 1)
        <x-manta::buttons.large type="read" :href="route($this->route_name . '.read', [$this->route_name => $item])" />
        <flux:button size="sm" icon="globe-alt" wire:click="translate">Vul lege vertalingen</flux:button>
    @endif
    <br> <br>
    <input type="text" wire:model="title" />
    @include('manta::includes.form_field_list')
</flux:main>
