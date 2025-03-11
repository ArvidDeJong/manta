<flux:main container>
    <x-manta.breadcrumb :$breadcrumb />
    <div class="overflow-hidden bg-white shadow sm:rounded-lg">
        <div class="bg-gray-100 p-6">
            <div class="chat-box space-y-4">
                @foreach ($messages as $message)
                    <div class="chat-message">
                        <strong class="text-blue-600">{{ $message['user'] }}</strong>: {{ $message['message'] }}
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <form wire:submit.prevent="sendMessage" class="mt-6 flex items-center space-x-4">
        <input type="text" wire:model="messageText" placeholder="Schrijf je vraag..."
            class="flex-1 rounded-md border border-gray-300 px-4 py-2 shadow-sm focus:border-blue-500 focus:ring-blue-500">
        @error('messageText')
            <span class="text-sm text-red-500">{{ $message }}</span>
        @enderror
        @if (env('OPENAI_API_KEY'))
            <button type="submit"
                class="inline-flex items-center rounded-md border border-transparent bg-blue-600 px-4 py-2 font-semibold uppercase tracking-widest text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                Verstuur
            </button>
        @endif
    </form>
    @if (!env('OPENAI_API_KEY'))
        <div class="relative m-5 rounded border border-blue-400 bg-blue-100 px-4 py-3 text-blue-700" role="alert">
            <strong class="font-bold"><i class="fa-regular fa-triangle-exclamation"></i></strong>
            <span class="block sm:inline"> <strong class="text-blue-600">Geen abonnement</strong>: Vraag naar de
                mogelijkheden <a href="mailto:info@arvid.nl">info@arvid.nl</a></span>
        </div>
    @endif
</flux:main>
