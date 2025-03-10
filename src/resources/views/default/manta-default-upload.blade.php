<div class="mx-auto max-w-7xl py-6 sm:px-6 lg:px-8">
    <x-manta.breadcrumb :$breadcrumb />

    @include('manta::default.manta-default-tabs', [
        'tabs' => $tablistModule,
        'tablistShow' => $tablistModuleShow,
    ])

    <livewire:manta::upload.upload-form :model_class="$item" />
    <livewire:manta::upload.upload-overview :model_class="$item" :key="'overview' . time()" />
</div>
