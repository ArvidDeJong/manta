<flux:table.row data-id="{{ $item->id }}">
    @if ($fields['uploads']['active'])
        <flux:table.cell><x-manta.tables.image :item="$item->image" /></flux:table.cell>
    @endif
    <flux:table.cell>{{ $item->title }}</flux:table.cell>
    <flux:table.cell>
        @if (env('OPENAI_API_KEY'))
            <button wire:click="createSeoTitle({{ $item->id }})" class="btn btn-sm btn-primary">
                <span wire:loading wire:target="createSeoTitle({{ $item->id }})">
                    <i class="fa-solid fa-spinner fa-spin"></i>
                </span>
                <i class="fa-solid fa-circle-quarters"></i>
            </button>
        @endif
        {{ substr($item->seo_title, 0, 50) }}
    </flux:table.cell>
    <flux:table.cell>
        @if (env('OPENAI_API_KEY'))
            <button wire:click="createSeoDescription({{ $item->id }})" class="btn btn-sm btn-primary">
                <span wire:loading wire:target="createSeoDescription({{ $item->id }})">
                    <i class="fa-solid fa-spinner fa-spin"></i>
                </span>
                <i class="fa-solid fa-circle-quarters"></i>
            </button>
        @endif
        {{ substr($item->seo_description, 0, 50) }}
    </flux:table.cell>
    <flux:table.cell>{{ $item->route }}</flux:table.cell>

    <x-manta.flux.manta-flux-delete :$item :$route_name :$moduleClass :$fields :translatable="false" />
</flux:table.row>
