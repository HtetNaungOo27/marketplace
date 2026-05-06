<?php

namespace App\Livewire\Shop;

use Livewire\Component;
use App\Models\Order;
use App\Models\Payment;
use App\Models\VendorPayout;

use App\Models\OrderItem;

class Cart extends Component
{
    public $payment_method = 'CashOnDelivery';
    public $shipping_address = '';
    public function increase($id)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            $cart[$id]['quantity']++;
        }

        session()->put('cart', $cart);
    }

    public function decrease($id)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            if ($cart[$id]['quantity'] > 1) {
                $cart[$id]['quantity']--;
            }
        }

        session()->put('cart', $cart);
    }

    public function remove($id)
    {
        $cart = session()->get('cart', []);

        unset($cart[$id]);

        session()->put('cart', $cart);
    }

    public function mount()
    {
        $this->shipping_address = auth()->check()
            ? auth()->user()->customer?->shipping_address
            : '';
    }
    public function checkout()
    {
        $cart = session()->get('cart', []);

        if (empty($cart)) return;

        $customer = auth()->user()->customer;

        $total = collect($cart)->sum(fn($i) => $i['price'] * $i['quantity']);

        $this->validate([
            'shipping_address' => 'required|string|max:1000',
            'payment_method' => 'required|in:KBZPay,WavePay,CashOnDelivery,BankTransfer',
        ]);

        $customer = auth()->user()->customer;

        $customer->update([
            'shipping_address' => $this->shipping_address,
        ]);

        $order = \App\Models\Order::create([
            'customer_id' => $customer->id,
            'order_date' => now(),
            'total_amount' => $total,
            'order_status' => $this->payment_method === 'CashOnDelivery' ? 'Pending' : 'Paid',
        ]);

        foreach ($cart as $item) {
            \App\Models\OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item['id'],
                'quantity' => $item['quantity'],
                'unit_price' => $item['price'],
                'subtotal' => $item['price'] * $item['quantity'],
            ]);
        }

        // Save payment
        Payment::create([
            'order_id' => $order->id,
            'payment_method' => $this->payment_method,
            'payment_status' => $this->payment_method === 'CashOnDelivery' ? 'Pending' : 'Paid',
            'payment_date' => now(),
        ]);

        $commissionRate = 10;

        $vendorTotals = [];

        foreach ($cart as $item) {
            $product = \App\Models\Product::find($item['id']);

            if (!$product) {
                continue;
            }

            $vendorId = $product->vendor_id;
            $subtotal = $item['price'] * $item['quantity'];

            if (!isset($vendorTotals[$vendorId])) {
                $vendorTotals[$vendorId] = 0;
            }

            $vendorTotals[$vendorId] += $subtotal;
        }

        foreach ($vendorTotals as $vendorId => $grossAmount) {
            $commissionAmount = $grossAmount * ($commissionRate / 100);
            $netAmount = $grossAmount - $commissionAmount;

            VendorPayout::create([
                'vendor_id' => $vendorId,
                'order_id' => $order->id,
                'gross_amount' => $grossAmount,
                'commission_rate' => $commissionRate,
                'commission_amount' => $commissionAmount,
                'net_amount' => $netAmount,
                'payout_status' => 'Pending',
                'payout_date' => null,
            ]);
        }

        session()->forget('cart');

        return redirect()->route('orders.success', ['order' => $order->id]);
    }

    public function render()
    {
        return view('livewire.shop.cart')
            ->layout('layouts.marketplace');
    }
}
