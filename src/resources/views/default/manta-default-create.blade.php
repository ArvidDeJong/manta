<flux:main container>
    <x-manta.breadcrumb :$breadcrumb />
    @include('manta::default.manta-default-tabs', [
        'tabs' => $tablistModule,
        'tablistShow' => $tablistModuleShow,
    ])

    <div class="mb-8"></div>
    @include('manta::default.manta-default-openai-form')
    @include('manta::includes.form_field_list')
</flux:main>
