<div>

        <div class="min-h-screen bg-gray-50 p-6">
            <div class="max-w-7xl mx-auto space-y-8">

                <div class="flex items-center justify-between">
                    <div>
                        <h1 class="text-3xl font-bold text-gray-900">Product Management</h1>
                        <p class="text-gray-500 mt-1">Create, update, and manage your marketplace products.</p>
                    </div>
                </div>

                @if(session()->has('message'))
                <div class="rounded-xl bg-green-50 border border-green-200 px-4 py-3 text-green-700 shadow-sm">
                    {{ session('message') }}
                </div>
                @endif

                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

                    <!-- Product Form -->
                    <div class="lg:col-span-1">
                        <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6">
                            <h2 class="text-xl font-semibold text-gray-900 mb-5">
                                {{ $editing ? 'Edit Product' : 'Add New Product' }}
                            </h2>

                            <form wire:submit.prevent="saveProduct" class="space-y-5">

                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Product Name</label>
                                    <input type="text" wire:model="product_name"
                                        class="w-full rounded-xl border-gray-300 focus:border-indigo-500 focus:ring-indigo-500"
                                        placeholder="e.g. Wireless Headphones">
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                                    <textarea wire:model="description" rows="4"
                                        class="w-full rounded-xl border-gray-300 focus:border-indigo-500 focus:ring-indigo-500"
                                        placeholder="Describe your product"></textarea>
                                </div>

                                <div class="grid grid-cols-2 gap-4">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Price</label>
                                        <input type="number" step="0.01" wire:model="price"
                                            class="w-full rounded-xl border-gray-300 focus:border-indigo-500 focus:ring-indigo-500"
                                            placeholder="0.00">
                                    </div>

                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Stock</label>
                                        <input type="number" wire:model="stock_quantity"
                                            class="w-full rounded-xl border-gray-300 focus:border-indigo-500 focus:ring-indigo-500"
                                            placeholder="0">
                                    </div>
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Category</label>
                                    <select wire:model="category_id"
                                        class="w-full rounded-xl border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                                        <option value="">Select category</option>
                                        @foreach($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Product Image</label>
                                    <input type="file" wire:model="image"
                                        class="w-full rounded-xl border border-gray-300 px-3 py-2 bg-white text-sm">
                                </div>

                                <div class="flex gap-3 pt-2">
                                    <button type="submit"
                                        class="flex-1 rounded-xl bg-indigo-600 px-4 py-3 text-white font-medium shadow-sm hover:bg-indigo-700 transition">
                                        {{ $editing ? 'Update Product' : 'Create Product' }}
                                    </button>

                                    @if($editing)
                                    <button type="button" wire:click="resetForm"
                                        class="rounded-xl bg-gray-100 px-4 py-3 text-gray-700 font-medium hover:bg-gray-200 transition">
                                        Cancel
                                    </button>
                                    @endif
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- Product List -->
                    <div class="lg:col-span-2">
                        <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6">
                            <div class="flex items-center justify-between mb-5">
                                <h2 class="text-xl font-semibold text-gray-900">My Products</h2>
                                <span class="text-sm text-gray-500">{{ $products->count() }} products</span>
                            </div>

                            @if($products->count() === 0)
                            <div class="text-center py-16 border-2 border-dashed border-gray-200 rounded-2xl">
                                <h3 class="text-lg font-semibold text-gray-700">No products yet</h3>
                                <p class="text-gray-500 mt-1">Create your first product to start selling.</p>
                            </div>
                            @else
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                                @foreach($products as $product)
                                <div class="rounded-2xl border border-gray-200 overflow-hidden bg-white hover:shadow-md transition">

                                    @if($product->image)
                                    <img src="{{ asset('storage/' . $product->image) }}"
                                        class="w-full h-44 object-cover">
                                    @else
                                    <div class="w-full h-44 bg-gray-100 flex items-center justify-center text-gray-400">
                                        No Image
                                    </div>
                                    @endif

                                    <div class="p-5 space-y-3">
                                        <div class="flex items-start justify-between gap-3">
                                            <div>
                                                <h3 class="font-semibold text-gray-900 text-lg">
                                                    {{ $product->product_name }}
                                                </h3>
                                                <p class="text-sm text-gray-500">
                                                    {{ $product->category->category_name ?? 'No category' }}
                                                </p>
                                            </div>

                                            <span class="rounded-full px-3 py-1 text-xs font-medium
                                                {{ $product->status === 'Available' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                                                {{ $product->status }}
                                            </span>
                                        </div>

                                        <p class="text-sm text-gray-500 line-clamp-2">
                                            {{ $product->description }}
                                        </p>

                                        <div class="flex items-center justify-between">
                                            <div>
                                                <p class="text-xl font-bold text-gray-900">${{ $product->price }}</p>
                                                <p class="text-sm text-gray-500">Stock: {{ $product->stock_quantity }}</p>
                                            </div>

                                            <div class="flex gap-2">
                                                <button wire:click="editProduct({{ $product->id }})"
                                                    class="rounded-lg bg-yellow-100 px-3 py-2 text-sm font-medium text-yellow-700 hover:bg-yellow-200 transition">
                                                    Edit
                                                </button>

                                                <button wire:click="deleteProduct({{ $product->id }})"
                                                    onclick="return confirm('Delete this product?')"
                                                    class="rounded-lg bg-red-100 px-3 py-2 text-sm font-medium text-red-700 hover:bg-red-200 transition">
                                                    Delete
                                                </button>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                @endforeach
                            </div>
                            @endif
                        </div>
                    </div>

                </div>
            </div>
        </div>
</div>