<?php

namespace App\Livewire\Shop;

use App\Models\Category;
use App\Models\Product;
use Livewire\Component;

class ProductListing extends Component
{
    public $search = '';
    public $category_id = '';
    public $sort = 'latest';

    public function mount()
    {
        $this->category_id = request('category', '');
    }

    public function render()
    {
        $products = Product::with(['category', 'vendor'])
            ->where('status', 'Available')
            ->when($this->search, function ($query) {
                $query->where('product_name', 'like', '%' . $this->search . '%');
            })
            ->when($this->category_id, function ($query) {
                $query->where('category_id', $this->category_id);
            })
            ->when($this->sort === 'price_low', function ($query) {
                $query->orderBy('price', 'asc');
            })
            ->when($this->sort === 'price_high', function ($query) {
                $query->orderBy('price', 'desc');
            })
            ->when($this->sort === 'latest', function ($query) {
                $query->latest();
            })
            ->get();

        return view('livewire.shop.product-listing', [
            'products' => $products,
            'categories' => Category::withCount('products')->get(),
        ])->layout('layouts.marketplace');
    }
}