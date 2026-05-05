<?php

namespace App\Livewire\Vendor;

use Livewire\Component;
use App\Models\Product;
use App\Models\Category;

class ProductManager extends Component
{
    public $product_id;
    public $product_name;
    public $description;
    public $price;
    public $stock_quantity;
    public $category_id;
    public $editing = false;

    public function saveProduct()
    {
        $this->validate([
            'product_name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'stock_quantity' => 'required|integer|min:0',
            'category_id' => 'required|exists:categories,id',
        ]);

        Product::updateOrCreate(
            ['id' => $this->product_id],
            [
                'vendor_id' => auth()->user()->vendor->id,
                'category_id' => $this->category_id,
                'product_name' => $this->product_name,
                'description' => $this->description,
                'price' => $this->price,
                'stock_quantity' => $this->stock_quantity,
                'status' => $this->stock_quantity > 0 ? 'Available' : 'OutOfStock',
            ]
        );

        $this->resetForm();

        session()->flash('message', 'Product saved successfully.');
    }

    public function editProduct($id)
    {
        $product = Product::where('vendor_id', auth()->user()->vendor->id)
            ->findOrFail($id);

        $this->product_id = $product->id;
        $this->product_name = $product->product_name;
        $this->description = $product->description;
        $this->price = $product->price;
        $this->stock_quantity = $product->stock_quantity;
        $this->category_id = $product->category_id;
        $this->editing = true;
    }

    public function deleteProduct($id)
    {
        Product::where('vendor_id', auth()->user()->vendor->id)
            ->findOrFail($id)
            ->delete();

        session()->flash('message', 'Product deleted successfully.');
    }

    public function resetForm()
    {
        $this->reset([
            'product_id',
            'product_name',
            'description',
            'price',
            'stock_quantity',
            'category_id',
            'editing',
        ]);
    }

    public function render()
{
    return view('livewire.vendor.product-manager', [
        'products' => Product::where('vendor_id', auth()->user()->vendor->id)->latest()->get(),
        'categories' => Category::all(),
    ])->layout('layouts.marketplace');
}
}