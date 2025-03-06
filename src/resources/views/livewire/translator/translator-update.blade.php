<flux:main container>
    <x-manta.breadcrumb :$breadcrumb />

    <div class="mt-4 flex">
        <div class="flex-grow">
            <flux:button icon="pencil-square" wire:click="write"> Opslaan</flux:button>
        </div>
        <div class="w-1/5">

        </div>
    </div>

    <flux:table>
        <flux:table.columns>
            <flux:table.column>Titel</flux:table.column>
            <flux:table.column>Inhoud</flux:table.column>
        </flux:table.columns>
        </thead>
        <flux:table.rows>
            @foreach ($items as $key => $value)
                <flux:table.row :key="$key">
                    <flux:table.cell>
                        <a id="{!! $key !!}" style="scroll-margin-top: 150px;"> {!! nl2br(word_wrap($key, 10)) !!}</a>
                    </flux:table.cell>
                    <flux:table.cell>
                        <flux:textarea wire:model="items.{{ $key }}" rows="auto">{{ $value }}
                        </flux:textarea>

                    </flux:table.cell>
                </flux:table.row>
            @endforeach
        </flux:table.rows>
    </flux:table>
</flux:main>
