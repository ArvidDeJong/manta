<flux:table.row data-id="{{ $item->id }}">
    <flux:table.cell>
        <flux:avatar size="xs" src="{{ $item->customer_avatar }}" />
        {{ $item->id }}
    </flux:table.cell>
    <flux:table.cell>
        {{ $item->description }}
    </flux:table.cell>
    <flux:table.cell>
        {{ $item->title }}
    </flux:table.cell>

    @if (isset($fields['option_1']['active']) && $fields['option_1']['active'])
        <flux:table.cell>
            {!! $item->option_1 ? '<i class="fa-solid fa-check"></i>' : null !!}
        </flux:table.cell>
    @endif
    <flux:table.cell variant="strong">
        {{ count($item->uploads) > 0 ? count($item->uploads) : null }}
    </flux:table.cell>
    @if ($fields['homepage']['active'])
        <flux:table.cell>
            {!! $item->homepage ? '<i class="fa-solid fa-check"></i>' : null !!}
        </flux:table.cell>
        <flux:table.cell>
            {{ $item->homepageSort }}
        </flux:table.cell>
    @endif
    <flux:table.cell>
        @if ($item->slug && Route::has('nl.website.page'))
            <a href="{{ route('website.page', ['slug' => $item->slug]) }}" target="_blank"
                class="text-blue-500 hover:text-blue-800"> {{ $item->slug }} </a>
        @elseif ($item->slug && Route::has('website.page'))
            <a href="{{ route('website.page', ['slug' => $item->slug]) }}" target="_blank"
                class="text-blue-500 hover:text-blue-800"> {{ $item->slug }} </a>
        @else
            {{ $item->slug }}
        @endif
    </flux:table.cell>

    <x-manta::flux.manta-flux-delete :$item :$route_name :$moduleClass uploads :$fields />
</flux:table.row>
