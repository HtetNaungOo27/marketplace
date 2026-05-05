<div class="p-6 max-w-5xl mx-auto">
    <h1 class="text-2xl font-bold mb-6">Vendor Products</h1>

    @if(session()->has('message'))
        <div class="mb-4 p-3 bg-green-100 text-green-700 rounded">
            {{ session('message') }}
        </div>
    @endif

    <form wire:submit.prevent="saveProduct" class="space-y-4 mb-8">
        <input type="text" wire:model="product_name" placeholder="Product Name" class="border p-2 w-full rounded">

        <textarea wire:model="description" placeholder="Description" class="border p-2 w-full rounded"></textarea>

        <input type="number" step="0.01" wire:model="price" placeholder="Price" class="border p-2 w-full rounded">

        <input type="number" wire:model="stock_quantity" placeholder="Stock" class="border p-2 w-full rounded">

        <select wire:model="category_id" class="border p-2 w-full rounded">
            <option value="">Select Category</option>
            @foreach($categories as $category)
                <option value="{{ $category->id }}">{{ $category->category_name }}</option>
            @endforeach
        </select>

        <input type="file" wire:model="image" class="border p-2 w-full rounded">

        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">
            {{ $editing ? 'Update Product' : 'Create Product' }}
        </button>

        @if($editing)
            <button type="button" wire:click="resetForm" class="bg-gray-500 text-white px-4 py-2 rounded">
                Cancel
            </button>
        @endif
    </form>

    <h2 class="text-xl font-bold mb-4">My Products</h2>

    <div class="space-y-3">
        @foreach($products as $product)
            <div class="border p-4 rounded flex justify-between items-center">
                <div class="flex gap-4 items-center">
                    @if($product->image)
                        <img src="{{ asset('storage/' . $product->image) }}" class="w-20 h-20 object-cover rounded">
                    @endif

                    <div>
                        <h3 class="font-bold">{{ $product->product_name }}</h3>
                        <p>${{ $product->price }} | Stock: {{ $product->stock_quantity }}</p>
                        <p>Status: {{ $product->status }}</p>
                    </div>
                </div>

                <div class="space-x-2">
                    <button wire:click="editProduct({{ $product->id }})" class="bg-yellow-500 text-white px-3 py-1 rounded">
                        Edit
                    </button>

                    <button wire:click="deleteProduct({{ $product->id }})" class="bg-red-600 text-white px-3 py-1 rounded">
                        Delete
                    </button>
                </div>
            </div>
        @endforeach
    </div>
</div>