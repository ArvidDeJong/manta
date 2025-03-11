    <flux:main container class="flex items-center justify-center min-h-screen">
        <flux:card class="w-full max-w-sm space-y-6">
            <img class="w-auto h-10 mx-auto" src="{{ env('DEFAULT_LOGO_LOGIN') ?: '/vendor/manta/default/img/logo-cutout.png' }}"
                alt="{{ env('DEFAULT_COMPANY') }}">

            <flux:heading size="lg" class="text-center">Wachtwoord vergeten</flux:heading>

            <form class="space-y-6" wire:submit.prevent="sendResetLink">
                <flux:field class="space-y-2">
                    <flux:label for="email">Email</flux:label>
                    <flux:input id="email" name="email" type="email" wire:model="email" required
                        autocomplete="email" placeholder="Vul je emailadres in" />
                    <flux:error name="email" />
                </flux:field>

                @if ($status)
                    <div class="p-4 mt-3 text-blue-700 border-l-4 border-blue-500 rounded-md bg-blue-50">
                        {{ $status }}
                    </div>
                @endif

                <div class="flex items-center justify-between">
                    <flux:link href="{{ route('staff.login') }}" variant="subtle" class="text-sm">
                        Terug naar inloggen
                    </flux:link>
                </div>

                <div class="mt-6">
                    <flux:button type="submit" wire:loading.attr="disabled" variant="primary" class="w-full">
                        <span wire:loading.remove>Verzend wachtwoord reset link</span>
                        <span wire:loading class="flex items-center">
                            <i class="fas fa-spinner fa-spin"></i>
                            <span class="ml-2">Even wachten</span>
                        </span>
                    </flux:button>
                </div>
            </form>
        </flux:card>
    </flux:main>
