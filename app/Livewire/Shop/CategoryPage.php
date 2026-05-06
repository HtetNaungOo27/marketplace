<?php

namespace App\Livewire\Shop;

use App\Models\Category;
use Livewire\Component;

class CategoryPage extends Component
{
    public function render()
    {
        return view('livewire.shop.category-page', [
            'categories' => Category::withCount('products')->get(),
        ])->layout('layouts.marketplace');
    }
}