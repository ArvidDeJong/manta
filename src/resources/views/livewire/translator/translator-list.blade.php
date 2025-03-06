<flux:main container>
    <x-manta.breadcrumb :$breadcrumb />
    <div class="flex">
        <div class="flex-grow">
            <flux:button wire:click="createMissing" icon="plus">
                Maak ontbrekende bestanden aan
            </flux:button>
        </div>
        <div class="flex-none">
            <!-- Extra kolom ruimte of andere inhoud -->
        </div>
    </div>

    <flux:table>
        <flux:table.columns>
            {{-- <flux:table.column>Customer</flux:table.column> --}}
            <flux:table.column>Titel</flux:table.column>
        </flux:table.columns>
        </thead>
        <flux:table.rows>
            @foreach ($items as $key => $value)
                @if ($value != '.' && $value != '..' && $value != '.DS_Store')
                    @if (
                        (!$directory_add || ($directory_add && str_contains($value, env('THEME')))) &&
                            in_array(substr($value, 0, 2), $supported))
                        <flux:table.row :key="$key">
                            {{-- <flux:table.cell>
                                @if ($value == getLocaleManta())
                                    <i class="fa-solid fa-check"></i>
                                @endif
                            </flux:table.cell> --}}
                            <flux:table.cell>

                                @if (is_dir($directory . $directory_add . $value))
                                    {{-- <a href="javascript:;"
                                        wire:click="$set('directory_add', '{{ $value }}/')">{{ $value }}</a> --}}
                                    {{ $value }}
                                @else
                                    <a
                                        href="{{ route('translator.update', ['file' => $directoryUrl . $directory_add . $value]) }}">{{ $value }}</a>
                                @endif
                            </flux:table.cell>
                            <flux:table.cell>
                                @if (!is_dir($directory . $directory_add . $value))
                                    {{-- <button wire:click="readFile('/{{ $value }}')">Lees</button> --}}
                                @else
                                    <ul>
                                        @foreach ($this->translate_files as $keyf => $valuef)
                                            @if (str_contains($valuef, env('THEME')))
                                                <li>
                                                    @if (file_exists($directory . $directory_add . $value . '/' . $valuef))
                                                        <i class="fa-solid fa-check text-success"></i>
                                                        <a
                                                            href="{{ route('translator.update', ['file' => $directoryUrl . $directory_add . $value . '/' . $valuef]) }}">{{ $valuef }}</a>
                                                    @else
                                                        <i class="fa-solid fa-xmark text-danger"></i> {{ $valuef }}
                                                    @endif

                                                </li>
                                            @endif
                                        @endforeach
                                    </ul>
                                @endif
                            </flux:table.cell>
                        </flux:table.row>
                    @endif
                @endif
            @endforeach
        </flux:table.rows>
    </flux:table>
</flux:main>
