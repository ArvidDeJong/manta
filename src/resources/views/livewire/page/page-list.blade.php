<flux:main>
    <x-manta.breadcrumb :$breadcrumb />
    <div class="mt-4 flex">
        <div class="flex-grow">
            <x-manta.buttons.large type="add" :href="route($this->route_name . '.create')" />

        </div>
        <div class="w-1/5">
            <x-manta.input.search />
        </div>
    </div>
    <x-manta.tables.tabs :$tablistShow :$trashed />
    <flux:table :paginate="$items">
        <flux:table.columns>
            <flux:table.column>ID</flux:table.column>
            <flux:table.column sortable :sorted="$sortBy === 'description'" :direction="$sortDirection"
                wire:click="dosort('description')">
                Beschrijving</flux:table.column>
            <flux:table.column sortable :sorted="$sortBy === 'title'" :direction="$sortDirection"
                wire:click="dosort('title')">
                Titel</flux:table.column>
            @if (isset($fields['option_1']['active']) && $fields['option_1']['active'])
                <flux:table.column sortable :sorted="$sortBy === 'option_1'" :direction="$sortDirection"
                    wire:click="dosort('option_1')">
                    Policy</flux:table.column>
            @endif
            <flux:table.column>Uploads</flux:table.column>
            @if ($fields['homepage']['active'])
                <flux:table.column sortable :sorted="$sortBy === 'homepage'" :direction="$sortDirection"
                    wire:click="dosort('homepage')">
                    Homepage</flux:table.column>
                <flux:table.column sortable :sorted="$sortBy === 'homepageSort'" :direction="$sortDirection"
                    wire:click="dosort('homepageSort')">
                    Sorteer</flux:table.column>
            @endif

            <flux:table.column sortable :sorted="$sortBy === 'slug'" :direction="$sortDirection"
                wire:click="dosort('slug')">
                Slug</flux:table.column>

        </flux:table.columns>
        <flux:table.rows>
            @foreach ($items as $item)
                @livewire('manta::page.page-list-row', ['fields' => $fields, 'item' => $item, 'route_name' => $this->route_name, 'moduleClass' => $moduleClass], key($item->id))
            @endforeach
        </flux:table.rows>
    </flux:table>
</flux:main>
