    <flux:main container class="flex items-center justify-center min-h-screen">
        <flux:card class="w-full max-w-sm space-y-6">

            <img class="w-auto h-10 mx-auto" src="{{ env('DEFAULT_LOGO_LOGIN') ?: '/vendor/manta/default/img/logo-cutout.png' }}"
                alt="{{ env('DEFAULT_COMPANY') }}">

            <flux:heading size="lg" class="text-center">Wachtwoord reset</flux:heading>

            <form class="space-y-6" wire:submit.prevent="resetPassword">
                <input type="hidden" wire:model="token">

                <flux:field class="space-y-2">
                    <flux:label for="email">Email</flux:label>
                    <flux:input id="email" name="email" type="email" wire:model="email" required
                        autocomplete="email" placeholder="Vul je emailadres in" />
                    <flux:error name="email" />
                </flux:field>

                <flux:field class="space-y-2">
                    <flux:label for="password">Wachtwoord</flux:label>
                    <flux:input id="password" name="password" type="password" wire:model="password" required
                        autocomplete="current-password" placeholder="Voer je nieuwe wachtwoord in" />
                    <flux:error name="password" />
                </flux:field>

                <flux:field class="space-y-2">
                    <flux:label for="password_confirmation">Wachtwoord herhalen</flux:label>
                    <flux:input id="password_confirmation" name="password_confirmation" type="password"
                        wire:model="password_confirmation" required autocomplete="current-password"
                        placeholder="Herhaal je nieuwe wachtwoord" />
                    <flux:error name="password_confirmation" />
                </flux:field>

                @if (session()->has('status'))
                    <div class="p-4 mt-4 text-green-700 border-l-4 border-green-400 rounded-md bg-green-50">
                        {{ session('status') }}
                    </div>
                @endif

                <div class="mt-6">
                    <flux:button type="submit" wire:loading.attr="disabled" variant="primary" class="w-full">
                        <span wire:loading.remove>Resetten</span>
                        <span wire:loading class="flex items-center">
                            <i class="fas fa-spinner fa-spin"></i>
                            <span class="ml-2">Even wachten</span>
                        </span>
                    </flux:button>
                </div>
            </form>
        </flux:card>
    </flux:main>
