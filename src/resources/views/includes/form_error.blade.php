@if ($errors->any())
    <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4" role="alert">
        <p class="font-bold">Let op, er zijn fouten gevonden:</p>
        @if ($errors->all())
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        @endif
    </div>
@endif
@if (session()->has('success'))
    <div class="bg-blue-100 border-l-4 border-blue-500 text-blue-700 p-4" role="alert">
        {!! session('success') !!}
    </div>
@endif
@if (session()->has('message'))
    <div class="bg-blue-100 border-l-4 border-blue-500 text-blue-700 p-4" role="alert">
        {!! session('message') !!}
    </div>
@endif
