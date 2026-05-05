<?php

namespace App\Livewire\Shop;

use App\Models\Category;
use App\Models\Product;
use Livewire\Component;

class ProductListing extends Component
{
    public $search = '';
    public $category_id = '';

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
            ->latest()
            ->get();

        return view('livewire.shop.product-listing', [
            'products' => $products,
            'categories' => Category::all(),
        ])->layout('layouts.marketplace');
    }
}