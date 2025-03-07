<flux:main container>
    <x-manta.breadcrumb :$breadcrumb />

    @include('manta::default.manta-default-tabs', [
        'tabs' => $tablistModule,
        'tablistShow' => $tablistModuleShow,
    ])
    @include('manta.includes.form_field_list-settings')
</flux:main>
