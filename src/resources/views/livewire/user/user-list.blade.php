<flux:main container>
    <x-manta.breadcrumb :$breadcrumb />
    <div class="mt-4 flex">
        <div class="flex-grow">
            <x-manta::buttons.large type="add" :href="route($this->route_name . '.create')" />
        </div>
        <div class="w-1/5">
            <x-manta.input.search />
        </div>
    </div>
    <x-manta.tables.tabs :$tablistShow :$trashed />
    <flux:table :paginate="$items">
        <flux:table.columns>
            <flux:table.column sortable :sorted="$sortBy === 'name'" :direction="$sortDirection"
                wire:click="dosort('name')">
                Naam</flux:table.column>
            <flux:table.column sortable :sorted="$sortBy === 'email'" :direction="$sortDirection"
                wire:click="dosort('email')">
                Email</flux:table.column>
            <flux:table.column sortable :sorted="$sortBy === 'active'" :direction="$sortDirection"
                wire:click="dosort('active')">
                Actief</flux:table.column>
        </flux:table.columns>
        <flux:table.rows>
            @foreach ($items as $item)
                <livewire:manta.user.user-list-row :$fields :$item :route_name="$this->route_name" :$moduleClass :key="$item->id">
            @endforeach
        </flux:table.rows>
    </flux:table>
</flux:main>
