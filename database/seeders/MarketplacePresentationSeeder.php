<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Customer;
use App\Models\Delivery;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Payment;
use App\Models\Product;
use App\Models\Review;
use App\Models\User;
use App\Models\Vendor;
use App\Models\VendorPayout;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class MarketplacePresentationSeeder extends Seeder
{
    public function run(): void
    {
        // =========================
        // USERS
        // =========================

        $admin = User::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'phone' => '0999999999',
            'password' => Hash::make('password'),
            'role' => 'Admin',
        ]);

        $vendorUser = User::create([
            'name' => 'Tech Store Owner',
            'email' => 'vendor@example.com',
            'phone' => '0911111111',
            'password' => Hash::make('password'),
            'role' => 'Vendor',
        ]);

        $customerUser = User::create([
            'name' => 'John Customer',
            'email' => 'customer@example.com',
            'phone' => '0922222222',
            'password' => Hash::make('password'),
            'role' => 'Customer',
        ]);

        $deliveryUser = User::create([
            'name' => 'Delivery Staff',
            'email' => 'delivery@example.com',
            'phone' => '0933333333',
            'password' => Hash::make('password'),
            'role' => 'Delivery',
        ]);

        // =========================
        // CUSTOMER
        // =========================

        $customer = Customer::create([
            'user_id' => $customerUser->id,
            'shipping_address' => 'Yangon, Myanmar',
        ]);

        // =========================
        // VENDOR
        // =========================

        $vendor = Vendor::create([
            'user_id' => $vendorUser->id,
            'store_name' => 'Tech World Store',
            'business_license' => 'LIC-DEMO-001',
            'approval_status' => 'Approved',
            'join_date' => now(),
        ]);

        // =========================
        // CATEGORIES
        // =========================

        $electronics = Category::create([
            'category_name' => 'Electronics',
        ]);

        $fashion = Category::create([
            'category_name' => 'Fashion',
        ]);

        $home = Category::create([
            'category_name' => 'Home & Living',
        ]);

        // =========================
        // PRODUCTS
        // =========================

        $laptop = Product::create([
            'vendor_id' => $vendor->id,
            'category_id' => $electronics->id,
            'product_name' => 'Gaming Laptop',
            'description' => 'High-performance gaming laptop with RTX graphics.',
            'price' => 1200,
            'stock_quantity' => 10,
            'status' => 'Available',
        ]);

        $headphone = Product::create([
            'vendor_id' => $vendor->id,
            'category_id' => $electronics->id,
            'product_name' => 'Wireless Headphones',
            'description' => 'Noise cancelling bluetooth headphones.',
            'price' => 120,
            'stock_quantity' => 20,
            'status' => 'Available',
        ]);

        $hoodie = Product::create([
            'vendor_id' => $vendor->id,
            'category_id' => $fashion->id,
            'product_name' => 'Black Hoodie',
            'description' => 'Premium oversized hoodie.',
            'price' => 45,
            'stock_quantity' => 30,
            'status' => 'Available',
        ]);

        // =========================
        // ORDER
        // =========================

        $order = Order::create([
            'customer_id' => $customer->id,
            'order_date' => now(),
            'total_amount' => 1320,
            'order_status' => 'Delivered',
        ]);

        // =========================
        // ORDER ITEMS
        // =========================

        OrderItem::create([
            'order_id' => $order->id,
            'product_id' => $laptop->id,
            'quantity' => 1,
            'unit_price' => 1200,
            'subtotal' => 1200,
        ]);

        OrderItem::create([
            'order_id' => $order->id,
            'product_id' => $headphone->id,
            'quantity' => 1,
            'unit_price' => 120,
            'subtotal' => 120,
        ]);

        // =========================
        // PAYMENT
        // =========================

        Payment::create([
            'order_id' => $order->id,
            'payment_method' => 'KBZPay',
            'payment_status' => 'Paid',
            'payment_date' => now(),
        ]);

        // =========================
        // DELIVERY
        // =========================

        Delivery::create([
            'order_id' => $order->id,
            'delivery_staff_id' => $deliveryUser->id,
            'tracking_number' => 'TRK-DEMO-1001',
            'delivery_status' => 'Delivered',
            'delivery_date' => now(),
        ]);

        // =========================
        // REVIEW
        // =========================

        Review::create([
            'customer_id' => $customer->id,
            'product_id' => $laptop->id,
            'rating' => 5,
            'comment' => 'Amazing product and fast delivery!',
            'review_date' => now(),
        ]);

        // =========================
        // VENDOR PAYOUT
        // =========================

        VendorPayout::create([
            'vendor_id' => $vendor->id,
            'order_id' => $order->id,
            'gross_amount' => 1320,
            'commission_rate' => 10,
            'commission_amount' => 132,
            'net_amount' => 1188,
            'payout_status' => 'Released',
            'payout_date' => now(),
        ]);
    }
}
