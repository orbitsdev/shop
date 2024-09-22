<x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <x-authentication-card-logo />
        </x-slot>

        <x-validation-errors class="mb-4" />

        @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div>
                <x-label for="email" value="{{ __('Email') }}" />
                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            </div>

            <div class="mt-4">
                <x-label for="password" value="{{ __('Password') }}" />
                <x-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" />
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-button class="w-full items-center justify-center">
                    {{ __('Log in') }}
                </x-button>
            </div>
        </form>

        <div class="mt-4 text-center">
            <span class="text-sm text-gray-600">{{ __('Don\'t have an account?') }}</span>
            <a href="{{ route('register') }}" class="text-sm text-cerise-red-600 hover:text-cerise-red-900">
                {{ __('Register here') }}
            </a>
        </div>

    </x-authentication-card>
</x-guest-layout>
