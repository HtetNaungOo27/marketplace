<x-layouts::auth :title="__('Log in')">
    {{-- Prevents any logo in the parent layout from appearing --}}
    <style>
        [slot="logo"], .auth-logo, svg.laravel-logo { display: none !important; }
    </style>

    <div class="flex flex-col gap-8">
        <!-- Marketplace Branding Header -->
        <div class="flex flex-col items-center justify-center text-center space-y-4">
            <div class="h-16 w-16 bg-indigo-600 rounded-[1.25rem] shadow-xl shadow-indigo-200 flex items-center justify-center text-white transform -rotate-6">
                <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                </svg>
            </div>
            <div>
                <h1 class="text-3xl font-black text-slate-900 tracking-tight italic uppercase">Market<span class="text-indigo-600">place</span></h1>
                <p class="text-slate-500 font-medium mt-1">{{ __('Welcome back! Please enter your details.') }}</p>
            </div>
        </div>

        <!-- Session Status -->
        <x-auth-session-status class="text-center" :status="session('status')" />

        <form method="POST" action="{{ route('login.store') }}" class="flex flex-col gap-6">
            @csrf

            <!-- Email Address -->
            <flux:input
                name="email"
                :label="__('Email address')"
                :value="old('email')"
                type="email"
                required
                autofocus
                autocomplete="email"
                class="!rounded-2xl border-slate-200 focus:ring-indigo-500"
                placeholder="email@example.com"
            />

            <!-- Password -->
            <div class="relative">
                <flux:input
                    name="password"
                    :label="__('Password')"
                    type="password"
                    required
                    autocomplete="current-password"
                    :placeholder="__('Password')"
                    class="!rounded-2xl border-slate-200 focus:ring-indigo-500"
                    viewable
                />

                @if (Route::has('password.request'))
                    <flux:link class="absolute top-0 text-xs font-bold end-0 !text-indigo-600 hover:underline" :href="route('password.request')" wire:navigate>
                        {{ __('Forgot password?') }}
                    </flux:link>
                @endif
            </div>

            <!-- Remember Me -->
            <flux:checkbox name="remember" :label="__('Keep me logged in')" :checked="old('remember')" class="text-slate-600" />

            <div class="pt-2">
                <flux:button type="submit" variant="primary" class="w-full !py-4 !rounded-2xl !bg-slate-900 hover:!bg-indigo-600 !font-black !uppercase !tracking-widest !text-xs shadow-xl shadow-slate-200 transition-all transform active:scale-[0.98]" data-test="login-button">
                    {{ __('Sign In') }}
                </flux:button>
            </div>
        </form>

        @if (Route::has('register'))
            <div class="text-sm text-center font-medium text-slate-500">
                <span>{{ __('New to the marketplace?') }}</span>
                <flux:link :href="route('register')" wire:navigate class="!text-indigo-600 !font-bold hover:!underline ml-1">
                    {{ __('Create an account') }}
                </flux:link>
            </div>
        @endif
    </div>
</x-layouts::auth>