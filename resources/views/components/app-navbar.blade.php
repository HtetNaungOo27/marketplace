<nav class="sticky top-0 z-50 border-b border-gray-200 bg-white/90 backdrop-blur">
    <div class="mx-auto max-w-7xl px-6">
        <div class="flex h-16 items-center justify-between">

            <a href="/" class="text-xl font-bold text-gray-900">
                Marketplace
            </a>

            <div class="hidden md:flex items-center gap-6 text-sm font-medium">
                <a href="/" class="text-gray-600 hover:text-indigo-600">Home</a>
                <a href="/categories" class="text-gray-600 hover:text-indigo-600">Categories</a>

                @auth
                    @if(auth()->user()->role === 'Vendor')
                        <a href="/vendor/dashboard" class="text-gray-600 hover:text-indigo-600">Dashboard</a>
                        <a href="/vendor/products" class="text-gray-600 hover:text-indigo-600">Products</a>
                    @endif

                    @if(auth()->user()->role === 'Customer')
                        <a href="/cart" class="text-gray-600 hover:text-indigo-600">Cart</a>
                        <a href="/orders" class="text-gray-600 hover:text-indigo-600">Orders</a>
                    @endif

                    @if(auth()->user()->role === 'Admin')
                        <a href="/admin" class="text-gray-600 hover:text-indigo-600">Admin</a>
                    @endif
                @endauth
            </div>

            <div class="flex items-center gap-3">
                @guest
                    <a href="{{ route('login') }}" class="text-sm font-medium text-gray-600 hover:text-indigo-600">
                        Login
                    </a>

                    <a href="{{ route('register') }}" class="rounded-xl bg-indigo-600 px-4 py-2 text-sm font-medium text-white hover:bg-indigo-700">
                        Register
                    </a>
                @else
                    <span class="hidden sm:block text-sm text-gray-600">
                        {{ auth()->user()->name }}
                    </span>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button class="rounded-xl bg-gray-100 px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-200">
                            Logout
                        </button>
                    </form>
                @endguest
            </div>

        </div>
    </div>
</nav>