<flux:table.row data-id="{{ $item->id }}">
    <flux:table.cell>{{ $tablekey + 1 }}</flux:table.cell>
    <flux:table.cell>{{ $item->name }}</flux:table.cell>
    <flux:table.cell>{{ $item->email }}</flux:table.cell>
    <flux:table.cell>
        {!! $item->active
            ? '<i class="text-green-600 fa-solid fa-check"></i>'
            : '<i class="text-red-600 fa-solid fa-xmark"></i>' !!}
    </flux:table.cell>
    <flux:table.cell>
        {!! $item->admin
            ? '<i class="text-green-600 fa-solid fa-check"></i>'
            : '<i class="text-red-600 fa-solid fa-xmark"></i>' !!}
    </flux:table.cell>
    <flux:table.cell>
        {!! $item->developer
            ? '<i class="text-green-600 fa-solid fa-check"></i>'
            : '<i class="text-red-600 fa-solid fa-xmark"></i>' !!}
    </flux:table.cell>
    <flux:table.cell>{{ $item->lastLogin ? Carbon\Carbon::parse($item->lastLogin)->format('d-m-Y H:i') : null }}
    </flux:table.cell>
    <x-manta.flux.manta-flux-delete :$item :$route_name :$moduleClass :translatable="false" />
</flux:table.row>
