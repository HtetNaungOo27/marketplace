<x-layouts::auth :title="__('Register')">
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
                <p class="text-slate-500 font-medium mt-1">{{ __('Create your merchant or buyer account') }}</p>
            </div>
        </div>

        <!-- Session Status -->
        <x-auth-session-status class="text-center" :status="session('status')" />

        <form method="POST" action="{{ route('register.store') }}" class="flex flex-col gap-5">
            @csrf
            
            <!-- Name -->
            <flux:input
                name="name"
                :label="__('Full Name')"
                :value="old('name')"
                type="text"
                required
                autofocus
                autocomplete="name"
                class="!rounded-2xl border-slate-200 focus:ring-indigo-500"
                placeholder="John Doe" />

            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                <!-- Email Address -->
                <flux:input
                    name="email"
                    :label="__('Email Address')"
                    :value="old('email')"
                    type="email"
                    required
                    class="!rounded-2xl border-slate-200 focus:ring-indigo-500"
                    placeholder="name@company.com" />

                <!-- Phone -->
                <flux:input
                    name="phone"
                    :label="__('Phone Number')"
                    :value="old('phone')"
                    type="text"
                    class="!rounded-2xl border-slate-200 focus:ring-indigo-500"
                    placeholder="09xxxxxxxxx" />
            </div>

            <!-- Role Selection upgraded to Flux -->
            <flux:select name="role" :label="__('Account Type')" required class="!rounded-2xl border-slate-200">
                <flux:select.option value="Customer" selected>{{ __('Customer (Buy Products)') }}</flux:select.option>
                <flux:select.option value="Vendor">{{ __('Vendor (Sell Products)') }}</flux:select.option>
            </flux:select>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                <!-- Password -->
                <flux:input
                    name="password"
                    :label="__('Password')"
                    type="password"
                    required
                    class="!rounded-2xl border-slate-200 focus:ring-indigo-500"
                    viewable />

                <!-- Confirm Password -->
                <flux:input
                    name="password_confirmation"
                    :label="__('Confirm')"
                    type="password"
                    required
                    class="!rounded-2xl border-slate-200 focus:ring-indigo-500"
                    viewable />
            </div>

            <div class="pt-4">
                <flux:button type="submit" variant="primary" class="w-full !py-4 !rounded-2xl !bg-slate-900 hover:!bg-indigo-600 !font-black !uppercase !tracking-widest !text-xs shadow-xl shadow-slate-200 transition-all transform active:scale-[0.98]">
                    {{ __('Join Marketplace') }}
                </flux:button>
            </div>
        </form>

        <div class="text-center text-sm font-medium text-slate-500">
            <span>{{ __('Already a member?') }}</span>
            <flux:link :href="route('login')" wire:navigate class="!text-indigo-600 !font-bold hover:!underline ml-1">
                {{ __('Log in here') }}
            </flux:link>
        </div>
    </div>
</x-layouts::auth>