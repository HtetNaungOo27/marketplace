<div class="min-h-screen bg-slate-50">

    {{-- Hero --}}
    <section class="border-b border-slate-200 bg-white">
        <div class="mx-auto max-w-7xl px-6 py-12">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-10 items-center">

                <div>
                    <p class="text-sm font-bold uppercase tracking-widest text-indigo-600">
                        Local Marketplace
                    </p>

                    <h1 class="mt-4 text-4xl md:text-5xl font-black tracking-tight text-slate-900">
                        Shop products from trusted vendors.
                    </h1>

                    <p class="mt-4 max-w-xl text-slate-500 text-lg leading-8">
                        Discover quality products, compare options, and order from verified local sellers.
                    </p>

                    <div class="mt-7 flex flex-wrap gap-3">
                        <a href="/categories"
                           class="rounded-2xl bg-indigo-600 px-5 py-3 text-sm font-bold text-white hover:bg-indigo-700 transition">
                            Browse Categories
                        </a>

                        <a href="/cart"
                           class="rounded-2xl border border-slate-300 bg-white px-5 py-3 text-sm font-bold text-slate-700 hover:bg-slate-50 transition">
                            View Cart
                        </a>
                    </div>
                </div>

                <div class="hidden lg:block">
                    <div class="rounded-[2rem] bg-slate-900 p-8 text-white shadow-xl">
                        <p class="text-sm text-indigo-200 font-semibold">Marketplace Flow</p>

                        <div class="mt-6 grid grid-cols-2 gap-4">
                            <div class="rounded-2xl bg-white/10 p-5">
                                <p class="text-3xl font-black">{{ $products->count() }}</p>
                                <p class="mt-1 text-sm text-slate-300">Available products</p>
                            </div>

                            <div class="rounded-2xl bg-white/10 p-5">
                                <p class="text-3xl font-black">{{ $categories->count() }}</p>
                                <p class="mt-1 text-sm text-slate-300">Categories</p>
                            </div>
                        </div>

                        <p class="mt-6 text-sm leading-6 text-slate-300">
                            Browse, add to cart, checkout, track delivery, and review products after purchase.
                        </p>
                    </div>
                </div>

            </div>
        </div>
    </section>

    {{-- Filters --}}
    <section class="mx-auto max-w-7xl px-6 py-8">
        <div class="rounded-3xl border border-slate-200 bg-white p-4 shadow-sm">
            <div class="grid grid-cols-1 lg:grid-cols-4 gap-4">

                <div class="lg:col-span-2">
                    <label class="mb-2 block text-xs font-bold uppercase tracking-widest text-slate-400">
                        Search
                    </label>

                    <input
                        type="text"
                        wire:model.live="search"
                        placeholder="Search products..."
                        class="w-full rounded-2xl border-slate-200 bg-slate-50 px-4 py-3 text-sm focus:border-indigo-500 focus:ring-indigo-500"
                    >
                </div>

                <div>
                    <label class="mb-2 block text-xs font-bold uppercase tracking-widest text-slate-400">
                        Category
                    </label>

                    <select
                        wire:model.live="category_id"
                        class="w-full rounded-2xl border-slate-200 bg-slate-50 px-4 py-3 text-sm focus:border-indigo-500 focus:ring-indigo-500"
                    >
                        <option value="">All Categories</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}">
                                {{ $category->category_name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="mb-2 block text-xs font-bold uppercase tracking-widest text-slate-400">
                        Sort
                    </label>

                    <select
                        wire:model.live="sort"
                        class="w-full rounded-2xl border-slate-200 bg-slate-50 px-4 py-3 text-sm focus:border-indigo-500 focus:ring-indigo-500"
                    >
                        <option value="latest">Latest</option>
                        <option value="price_low">Price: Low to High</option>
                        <option value="price_high">Price: High to Low</option>
                    </select>
                </div>

            </div>
        </div>
    </section>

    {{-- Products --}}
    <main class="mx-auto max-w-7xl px-6 pb-14">

        <div class="mb-6 flex items-center justify-between">
            <div>
                <h2 class="text-2xl font-black text-slate-900">Products</h2>
                <p class="mt-1 text-sm text-slate-500">
                    {{ $products->count() }} product{{ $products->count() === 1 ? '' : 's' }} found
                </p>
            </div>
        </div>

        @if($products->isEmpty())
            <div class="rounded-3xl border border-dashed border-slate-300 bg-white py-20 text-center">
                <h3 class="text-xl font-bold text-slate-900">No products found</h3>
                <p class="mt-2 text-slate-500">Try another search or category.</p>
            </div>
        @else
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach($products as $product)
                    <article class="group overflow-hidden rounded-3xl border border-slate-200 bg-white shadow-sm transition hover:-translate-y-1 hover:shadow-xl">

                        <a href="{{ route('products.show', $product) }}" class="block">
                            <div class="relative aspect-[4/3] overflow-hidden bg-slate-100">
                                @if($product->image)
                                    <img
                                        src="{{ asset('storage/' . $product->image) }}"
                                        class="h-full w-full object-cover transition duration-500 group-hover:scale-105"
                                    >
                                @else
                                    <div class="flex h-full w-full items-center justify-center text-slate-400">
                                        No Image
                                    </div>
                                @endif

                                <span class="absolute left-4 top-4 rounded-full bg-white/90 px-3 py-1 text-xs font-bold text-slate-700 shadow-sm">
                                    {{ $product->category->category_name ?? 'Uncategorized' }}
                                </span>
                            </div>
                        </a>

                        <div class="p-5">
                            <p class="text-xs font-bold uppercase tracking-wider text-indigo-600">
                                {{ $product->vendor->store_name ?? 'Vendor' }}
                            </p>

                            <a href="{{ route('products.show', $product) }}">
                                <h3 class="mt-2 line-clamp-2 text-lg font-black text-slate-900 group-hover:text-indigo-600 transition">
                                    {{ $product->product_name }}
                                </h3>
                            </a>

                            <p class="mt-2 line-clamp-2 text-sm leading-6 text-slate-500">
                                {{ $product->description ?: 'No description available.' }}
                            </p>

                            <div class="mt-5 flex items-end justify-between border-t border-slate-100 pt-4">
                                <div>
                                    <p class="text-2xl font-black text-slate-900">
                                        ${{ number_format($product->price, 2) }}
                                    </p>
                                    <p class="mt-1 text-xs font-semibold text-slate-400">
                                        Stock: {{ $product->stock_quantity }}
                                    </p>
                                </div>

                                <a href="{{ route('products.show', $product) }}"
                                   class="rounded-2xl bg-slate-900 px-4 py-3 text-xs font-bold text-white hover:bg-indigo-600 transition">
                                    View
                                </a>
                            </div>
                        </div>

                    </article>
                @endforeach
            </div>
        @endif

    </main>
</div>