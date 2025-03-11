<flux:main container class="flex min-h-screen items-center justify-center">
    <flux:card class="w-full max-w-sm space-y-6">
        <img class="mx-auto h-10 w-auto"
            src="{{ env('DEFAULT_LOGO_LOGIN') ? env('DEFAULT_LOGO_LOGIN') : '/vendor/manta/default/img/logo-cutout.png' }}"
            alt="{{ env('DEFAULT_COMPANY') }}">

        <flux:heading size="lg" class="text-center">Inloggen</flux:heading>

        <form class="space-y-6" wire:submit="login">
            <flux:field class="space-y-2">
                <flux:label for="email">Email</flux:label>
                <flux:input id="email" name="email" type="email" wire:model="email" autocomplete="email"
                    placeholder="Vul je emailadres in" />
                <flux:error name="email" />
            </flux:field>

            <flux:field class="space-y-2">
                <div class="flex items-center justify-between">
                    <flux:label for="password">Wachtwoord</flux:label>
                    <flux:link href="{{ route('staff.password.request') }}" variant="subtle" class="text-sm">
                        Wachtwoord vergeten?
                    </flux:link>
                </div>

                <flux:input id="password" name="password" type="password" wire:model="password" viewable
                    autocomplete="current-password" placeholder="Vul je wachtwoord in" />
                <flux:error name="password" />
            </flux:field>

            <flux:field class="flex items-center space-x-2">
                <flux:checkbox wire:model="remember" id="remember" />
                <flux:label for="remember" class="mt-3 text-sm text-gray-600">Onthouden</flux:label>
            </flux:field>

            @include('manta::includes.form_error')

            <div class="mt-6">
                <flux:button variant="primary" class="w-full" type="submit">Inloggen</flux:button>
            </div>
        </form>
    </flux:card>
</flux:main>
