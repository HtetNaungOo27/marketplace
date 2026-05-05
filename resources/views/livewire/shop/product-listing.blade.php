<div class="min-h-screen bg-gray-50">
    <section class="bg-white border-b border-gray-200">
        <div class="max-w-7xl mx-auto px-6 py-12">
            <h1 class="text-4xl font-bold text-gray-900">Shop products</h1>
            <p class="mt-3 text-gray-500">Browse products from trusted vendors.</p>

            <div class="mt-8 grid grid-cols-1 md:grid-cols-3 gap-4">
                <input
                    type="text"
                    wire:model.live="search"
                    placeholder="Search products..."
                    class="md:col-span-2 rounded-xl border-gray-300 focus:border-indigo-500 focus:ring-indigo-500"
                >

                <select
                    wire:model.live="category_id"
                    class="rounded-xl border-gray-300 focus:border-indigo-500 focus:ring-indigo-500"
                >
                    <option value="">All categories</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </section>

    <section class="max-w-7xl mx-auto px-6 py-10">
        @if($products->count() === 0)
            <div class="rounded-2xl border-2 border-dashed border-gray-200 bg-white py-20 text-center">
                <h2 class="text-xl font-semibold text-gray-800">No products found</h2>
                <p class="mt-2 text-gray-500">Try another search or category.</p>
            </div>
        @else
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach($products as $product)
                    <div class="group overflow-hidden rounded-2xl bg-white border border-gray-200 shadow-sm hover:shadow-md transition">
                        @if($product->image)
                            <img
                                src="{{ asset('storage/' . $product->image) }}"
                                class="h-52 w-full object-cover group-hover:scale-105 transition duration-300"
                            >
                        @else
                            <div class="h-52 w-full bg-gray-100 flex items-center justify-center text-gray-400">
                                No Image
                            </div>
                        @endif

                        <div class="p-5">
                            <div class="flex items-center justify-between gap-3">
                                <p class="text-sm text-indigo-600 font-medium">
                                    {{ $product->category->category_name ?? 'Uncategorized' }}
                                </p>

                                <span class="rounded-full bg-green-100 px-3 py-1 text-xs font-medium text-green-700">
                                    Available
                                </span>
                            </div>

                            <h3 class="mt-3 text-lg font-semibold text-gray-900">
                                {{ $product->product_name }}
                            </h3>

                            <p class="mt-1 text-sm text-gray-500">
                                {{ $product->vendor->store_name ?? 'Vendor' }}
                            </p>

                            <p class="mt-3 line-clamp-2 text-sm text-gray-500">
                                {{ $product->description }}
                            </p>

                            <div class="mt-5 flex items-center justify-between">
                                <p class="text-xl font-bold text-gray-900">
                                    ${{ number_format($product->price, 2) }}
                                </p>

                                <button class="rounded-xl bg-indigo-600 px-4 py-2 text-sm font-medium text-white hover:bg-indigo-700 transition">
                                    View
                                </button>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </section>
</div>