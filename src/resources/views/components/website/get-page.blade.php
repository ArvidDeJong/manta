@if($page)
    @if($edit && auth('staff')->user())
        {{ $page->{$attribute} }}
        <a href="{{ env('APP_URL') }}/cms/paginas/update/{{ $page->id }}" style="text-decoration: none; font-size: 12px; background-color: #fff;" target="_blank">
            <i class="fa-solid fa-pen-to-square"></i>
        </a>
    @else
        {{ $page->{$attribute} }}
    @endif
@endif
