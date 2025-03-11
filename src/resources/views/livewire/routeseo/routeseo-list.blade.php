     <flux:main container>
         <x-manta.breadcrumb :$breadcrumb />
         <div class="mt-4 flex">
             <div class="flex-grow">
                 <x-manta::buttons.large type="add" :href="route($this->route_name . '.create')" />
                 @if (count(getLocalesManta()) > 1)
                     <a href="javascript:;" wire:click="translateEmptyFields"
                         class="mr-2 rounded-sm bg-yellow-500 px-4 py-2 text-sm font-bold text-white hover:bg-yellow-600">
                         <span wire:loading.remove wire:target="translateEmptyFields"><i
                                 class="fa-solid fa-language"></i></span>
                         <span wire:loading wire:target="translateEmptyFields"><i
                                 class="fa-solid fa-spinner fa-spin"></i></span>
                         Vertaal lege talen
                     </a>
                 @endif
             </div>
             <div class="w-1/5">
                 <x-manta.input.search />
             </div>
         </div>
         <x-manta.tables.tabs :$tablistShow :$trashed />
         <flux:table :paginate="$items">
             <flux:table.columns>
                 @if ($this->fields['uploads']['active'])
                     <flux:table.column></flux:table.column>
                 @endif
                 <flux:table.column>Titel</flux:table.column>
                 <flux:table.column>SEO Titel</flux:table.column>
                 <flux:table.column>SEO Omschrijving</flux:table.column>
                 <flux:table.column>Route</flux:table.column>
                 <flux:table.column width="240"></flux:table.column>
             </flux:table.columns>

             <flux:table.rows>
                 @foreach ($items as $item)
                     @livewire('manta::routeseo.routeseo-list-row', ['fields' => $fields, 'item' => $item, 'route_name' => $this->route_name, 'moduleClass' => $moduleClass], key($item->id))
                 @endforeach
             </flux:table.rows>
         </flux:table>

     </flux:main>
