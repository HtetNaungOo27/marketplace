<?php

namespace App\Livewire\Shop;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Livewire\Component;
use App\Models\Review;

class ProductDetail extends Component
{
    public Product $product;
    public $quantity = 1;
    public $rating = 5;
    public $comment = '';

    public function mount(Product $product)
    {
        $this->product = $product->load([
            'category',
            'vendor.user',
            'reviews.customer.user',
        ]);
    }

    public function increaseQuantity()
    {
        if ($this->quantity < $this->product->stock_quantity) {
            $this->quantity++;
        }
    }

    public function decreaseQuantity()
    {
        if ($this->quantity > 1) {
            $this->quantity--;
        }
    }

    public function addToCart()
    {
        $cart = session()->get('cart', []);
        $id = $this->product->id;

        if (isset($cart[$id])) {
            $cart[$id]['quantity'] += $this->quantity;
        } else {
            $cart[$id] = [
                'id' => $this->product->id,
                'name' => $this->product->product_name,
                'price' => $this->product->price,
                'image' => $this->product->image,
                'quantity' => $this->quantity,
            ];
        }

        session()->put('cart', $cart);

        session()->flash('message', 'Product added to cart.');
    }

    public function buyNow()
    {
        $customer = auth()->user()->customer;

        $order = Order::create([
            'customer_id' => $customer->id,
            'order_date' => now(),
            'total_amount' => $this->product->price * $this->quantity,
            'order_status' => 'Pending',
        ]);

        OrderItem::create([
            'order_id' => $order->id,
            'product_id' => $this->product->id,
            'quantity' => $this->quantity,
            'unit_price' => $this->product->price,
            'subtotal' => $this->product->price * $this->quantity,
        ]);

        return redirect()->route('orders.success');
    }

    public function submitReview()
    {
        if (!auth()->check() || auth()->user()->role !== 'Customer') {
            abort(403);
        }

        $this->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string|max:1000',
        ]);

        Review::updateOrCreate(
            [
                'customer_id' => auth()->user()->customer->id,
                'product_id' => $this->product->id,
            ],
            [
                'rating' => $this->rating,
                'comment' => $this->comment,
                'review_date' => now(),
            ]
        );

        $this->product = Product::with([
            'category',
            'vendor.user',
            'reviews.customer.user',
        ])->findOrFail($this->product->id);

        $this->reset(['rating', 'comment']);
        $this->rating = 5;

        session()->flash('review_message', 'Review submitted successfully.');
    }
    public function render()
    {
        $relatedProducts = Product::with(['category', 'vendor'])
            ->where('category_id', $this->product->category_id)
            ->where('id', '!=', $this->product->id)
            ->where('status', 'Available')
            ->take(4)
            ->get();

        return view('livewire.shop.product-detail', [
            'relatedProducts' => $relatedProducts,
        ])->layout('layouts.marketplace');
    }
}
