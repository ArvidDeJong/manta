<flux:main container>
    <x-manta.breadcrumb :$breadcrumb />
    <div class="mt-4 flex">
        <div class="flex-grow">
        </div>
        <div class="w-1/5">
            <x-manta.input.search />
        </div>
    </div>
    <flux:table :paginate="$items">
        <flux:table.columns>
            <flux:table.column sortable :sorted="$sortBy === 'created_at'" :direction="$sortDirection"
                wire:click="dosort('created_at')">
                Aangemaakt</flux:table.column>
            <flux:table.column sortable :sorted="$sortBy === 'email'" :direction="$sortDirection"
                wire:click="dosort('email')">
                Email</flux:table.column>
            <flux:table.column sortable :sorted="$sortBy === 'email'" :direction="$sortDirection"
                wire:click="dosort('email')">
                Event</flux:table.column>
            <flux:table.column sortable :sorted="$sortBy === 'category'" :direction="$sortDirection"
                wire:click="dosort('category')">
                Categorie</flux:table.column>
        </flux:table.columns>
        <flux:table.rows>
            @foreach ($items as $item)
                <flux:table.row data-id="{{ $item->id }}">
                    <flux:table.cell>
                        {{ $item->created_at }}
                    </flux:table.cell>
                    <flux:table.cell>
                        {{ $item->email }}
                    </flux:table.cell>
                    <flux:table.cell>
                        {{ $item->event }}
                    </flux:table.cell>
                    <flux:table.cell>
                        {{ $item->category }}
                    </flux:table.cell>
                </flux:table.row>
            @endforeach
        </flux:table.rows>
    </flux:table>
</flux:main>
