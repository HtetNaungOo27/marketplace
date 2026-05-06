<nav class="sticky top-0 z-50 bg-white/80 backdrop-blur-xl border-b border-slate-200/60">
    <div class="mx-auto max-w-7xl px-6">
        <div class="flex h-20 items-center justify-between">

            <!-- Logo -->
            <a href="/" class="group flex items-center gap-3">
                <div class="h-10 w-10 bg-indigo-600 rounded-xl shadow-lg shadow-indigo-200 flex items-center justify-center text-white transform group-hover:-rotate-12 transition-transform duration-300">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                            d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                    </svg>
                </div>

                <span class="text-xl font-black text-slate-900 tracking-tighter uppercase italic">
                    Market<span class="text-indigo-600">place</span>
                </span>
            </a>

            <!-- Navigation -->
            <div class="hidden md:flex items-center gap-1 bg-slate-100/50 p-1 rounded-2xl border border-slate-200/50">

                @guest
                    <a href="/"
                        class="px-4 py-2 rounded-xl text-xs font-bold uppercase tracking-wider transition-all
                        {{ request()->is('/') ? 'bg-white text-indigo-600 shadow-sm' : 'text-slate-500 hover:text-slate-900' }}">
                        Home
                    </a>

                    <a href="/categories"
                        class="px-4 py-2 rounded-xl text-xs font-bold uppercase tracking-wider transition-all
                        {{ request()->is('categories*') ? 'bg-white text-indigo-600 shadow-sm' : 'text-slate-500 hover:text-slate-900' }}">
                        Categories
                    </a>
                @endguest

                @auth

                    {{-- Customer --}}
                    @if(auth()->user()->role === 'Customer')

                        <a href="/"
                            class="px-4 py-2 rounded-xl text-xs font-bold uppercase tracking-wider transition-all
                            {{ request()->is('/') ? 'bg-white text-indigo-600 shadow-sm' : 'text-slate-500 hover:text-slate-900' }}">
                            Shop
                        </a>

                        <a href="/categories"
                            class="px-4 py-2 rounded-xl text-xs font-bold uppercase tracking-wider transition-all
                            {{ request()->is('categories*') ? 'bg-white text-indigo-600 shadow-sm' : 'text-slate-500 hover:text-slate-900' }}">
                            Explore
                        </a>

                        <a href="/cart"
                            class="px-4 py-2 rounded-xl text-xs font-bold uppercase tracking-wider transition-all
                            {{ request()->is('cart*') ? 'bg-white text-indigo-600 shadow-sm' : 'text-slate-500 hover:text-slate-900' }}">
                            My Cart
                        </a>

                        <a href="/orders"
                            class="px-4 py-2 rounded-xl text-xs font-bold uppercase tracking-wider transition-all
                            {{ request()->is('orders*') ? 'bg-white text-indigo-600 shadow-sm' : 'text-slate-500 hover:text-slate-900' }}">
                            Orders
                        </a>

                    @endif

                    {{-- Vendor --}}
                    @if(auth()->user()->role === 'Vendor')

                        <a href="/vendor/dashboard"
                            class="px-4 py-2 rounded-xl text-xs font-bold uppercase tracking-wider transition-all
                            {{ request()->is('vendor/dashboard') ? 'bg-white text-indigo-600 shadow-sm' : 'text-slate-500 hover:text-slate-900' }}">
                            Studio
                        </a>

                        <a href="/vendor/products"
                            class="px-4 py-2 rounded-xl text-xs font-bold uppercase tracking-wider transition-all
                            {{ request()->is('vendor/products*') ? 'bg-white text-indigo-600 shadow-sm' : 'text-slate-500 hover:text-slate-900' }}">
                            Inventory
                        </a>

                        <a href="/vendor/orders"
                            class="px-4 py-2 rounded-xl text-xs font-bold uppercase tracking-wider transition-all
                            {{ request()->is('vendor/orders*') ? 'bg-white text-indigo-600 shadow-sm' : 'text-slate-500 hover:text-slate-900' }}">
                            Fulfillment
                        </a>

                        <a href="/vendor/payouts"
                            class="px-4 py-2 rounded-xl text-xs font-bold uppercase tracking-wider transition-all
                            {{ request()->is('vendor/payouts*') ? 'bg-white text-indigo-600 shadow-sm' : 'text-slate-500 hover:text-slate-900' }}">
                            Earnings
                        </a>

                    @endif

                    {{-- Delivery --}}
                    @if(auth()->user()->role === 'Delivery')

                        <a href="/delivery/dashboard"
                            class="px-4 py-2 rounded-xl text-xs font-bold uppercase tracking-wider transition-all
                            {{ request()->is('delivery/dashboard*') ? 'bg-white text-indigo-600 shadow-sm' : 'text-slate-500 hover:text-slate-900' }}">
                            Route Manifest
                        </a>

                    @endif

                    {{-- Admin --}}
                    @if(auth()->user()->role === 'Admin')

                        <a href="/admin"
                            class="px-4 py-2 rounded-xl text-xs font-bold uppercase tracking-wider transition-all
                            {{ request()->is('admin*') ? 'bg-white text-indigo-600 shadow-sm' : 'text-slate-500 hover:text-slate-900' }}">
                            System Control
                        </a>

                    @endif

                @endauth

            </div>

            <!-- Right Side -->
            <div class="flex items-center gap-4">

                @guest

                    <a href="{{ route('login') }}"
                        class="text-sm font-bold text-slate-600 hover:text-indigo-600 transition-colors px-4">
                        Login
                    </a>

                    <a href="{{ route('register') }}"
                        class="rounded-xl bg-slate-900 px-6 py-2.5 text-xs font-black uppercase tracking-widest text-white hover:bg-indigo-600 shadow-xl shadow-slate-200 transition-all transform active:scale-95">
                        Join Now
                    </a>

                @else

                    <div class="flex items-center gap-4 pl-4 border-l border-slate-200">

                        <div class="hidden sm:flex flex-col items-end">
                            <span class="text-xs font-black text-slate-900 tracking-tight leading-none italic">
                                {{ auth()->user()->name }}
                            </span>

                            <span class="text-[9px] font-bold text-indigo-500 uppercase tracking-widest leading-none mt-1">
                                {{ auth()->user()->role }}
                            </span>
                        </div>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <button
                                class="h-10 w-10 rounded-xl bg-slate-50 border border-slate-200 flex items-center justify-center text-slate-400 hover:text-rose-500 hover:bg-rose-50 hover:border-rose-100 transition-all">

                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                </svg>

                            </button>
                        </form>

                    </div>

                @endguest

            </div>

        </div>
    </div>
</nav>