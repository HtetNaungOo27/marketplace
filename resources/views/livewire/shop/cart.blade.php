<div class="min-h-screen bg-[#f8fafc] py-12">
    <div class="max-w-7xl mx-auto px-6">

        @php
            $cart = session('cart', []);
            $subtotal = collect($cart)->sum(fn($i) => $i['price'] * $i['quantity']);
            $itemCount = collect($cart)->sum('quantity');
        @endphp

        {{-- Header --}}
        <div class="flex flex-col md:flex-row md:items-end justify-between gap-6 mb-12">
            <div>
                <nav class="flex mb-4">
                    <a href="/" class="text-xs font-bold tracking-widest text-indigo-600 uppercase hover:text-indigo-700 transition">
                        Marketplace
                    </a>
                    <span class="mx-2 text-slate-300">/</span>
                    <span class="text-xs font-bold tracking-widest text-slate-400 uppercase">
                        Checkout
                    </span>
                </nav>

                <h1 class="text-4xl font-black text-slate-900 tracking-tight">
                    Shopping Cart
                </h1>

                <p class="text-slate-500 mt-2 font-medium text-lg">
                    Review your items and complete your order.
                </p>
            </div>

            <a href="/"
               class="inline-flex items-center justify-center rounded-2xl bg-white border border-slate-200 px-6 py-3 text-sm font-bold text-slate-700 shadow-sm hover:bg-indigo-50 hover:text-indigo-600 transition">
                ← Continue Shopping
            </a>
        </div>

        @if(empty($cart))

            {{-- Empty Cart --}}
            <div class="flex flex-col items-center justify-center py-28 bg-white rounded-[3rem] border border-slate-200 shadow-sm">
                <div class="relative mb-8">
                    <div class="absolute inset-0 bg-indigo-100 rounded-full animate-ping opacity-25"></div>

                    <div class="relative h-24 w-24 bg-indigo-50 rounded-full flex items-center justify-center text-indigo-400">
                        <svg class="w-12 h-12" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                        </svg>
                    </div>
                </div>

                <h2 class="text-2xl font-black text-slate-900">
                    Your cart is empty
                </h2>

                <p class="text-slate-500 mt-2 font-medium">
                    Add some products to start your order.
                </p>

                <a href="/"
                   class="mt-8 bg-slate-900 text-white px-10 py-4 rounded-2xl font-bold hover:bg-indigo-600 transition-all shadow-xl shadow-slate-200">
                    Browse Marketplace
                </a>
            </div>

        @else

            <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 items-start">

                {{-- Left Side --}}
                <div class="lg:col-span-8 space-y-10">

                    {{-- Cart Items --}}
                    <section class="bg-white rounded-[2.5rem] border border-slate-200 p-8 shadow-sm">
                        <div class="flex items-center justify-between mb-8">
                            <div>
                                <h2 class="text-xl font-black text-slate-900">
                                    Order Items
                                </h2>

                                <p class="text-sm text-slate-500 mt-1">
                                    {{ $itemCount }} item{{ $itemCount == 1 ? '' : 's' }} in your cart
                                </p>
                            </div>
                        </div>

                        <div class="space-y-5">
                            @foreach($cart as $item)
                                <div class="group relative flex flex-col sm:flex-row sm:items-center gap-6 p-5 bg-[#f8fafc] rounded-[2rem] border border-slate-100 hover:bg-white hover:shadow-xl hover:shadow-indigo-500/5 transition-all">

                                    <div class="h-28 w-28 rounded-3xl overflow-hidden bg-white border border-slate-100 flex-shrink-0">
                                        @if(!empty($item['image']))
                                            <img src="{{ asset('storage/' . $item['image']) }}"
                                                 class="w-full h-full object-cover">
                                        @else
                                            <div class="w-full h-full flex items-center justify-center text-slate-300">
                                                No Image
                                            </div>
                                        @endif
                                    </div>

                                    <div class="flex-1">
                                        <h3 class="font-black text-slate-900 leading-tight text-lg">
                                            {{ $item['name'] }}
                                        </h3>

                                        <p class="text-sm font-bold text-indigo-600 mt-1">
                                            ${{ number_format($item['price'], 2) }}
                                        </p>

                                        <div class="mt-5 flex items-center gap-4">
                                            <div class="flex items-center bg-white rounded-2xl p-1 border border-slate-200 shadow-sm">
                                                <button wire:click="decrease({{ $item['id'] }})"
                                                    class="w-9 h-9 flex items-center justify-center rounded-xl text-slate-400 hover:bg-slate-100 hover:text-slate-900 transition">
                                                    -
                                                </button>

                                                <span class="w-10 text-center text-sm font-black text-slate-900">
                                                    {{ $item['quantity'] }}
                                                </span>

                                                <button wire:click="increase({{ $item['id'] }})"
                                                    class="w-9 h-9 flex items-center justify-center rounded-xl text-slate-400 hover:bg-slate-100 hover:text-slate-900 transition">
                                                    +
                                                </button>
                                            </div>

                                            <button wire:click="remove({{ $item['id'] }})"
                                                class="text-xs font-black text-slate-400 hover:text-rose-500 uppercase tracking-widest transition">
                                                Remove
                                            </button>
                                        </div>
                                    </div>

                                    <div class="sm:text-right">
                                        <p class="text-xs font-black text-slate-400 uppercase tracking-widest mb-1">
                                            Subtotal
                                        </p>

                                        <p class="text-2xl font-black text-slate-900">
                                            ${{ number_format($item['price'] * $item['quantity'], 2) }}
                                        </p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </section>

                    {{-- Checkout Details --}}
                    <section class="bg-white rounded-[2.5rem] border border-slate-200 p-8 shadow-sm">
                        <h2 class="text-xl font-black text-slate-900 mb-8 flex items-center gap-3">
                            <span class="h-9 w-9 rounded-2xl bg-slate-900 text-white flex items-center justify-center text-xs font-black">
                                2
                            </span>
                            Checkout Details
                        </h2>

                        <div class="space-y-8">
                            <div>
                                <label class="block text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-4">
                                    Shipping Address
                                </label>

                                <textarea wire:model="shipping_address"
                                    rows="4"
                                    class="w-full rounded-3xl border-2 border-slate-100 bg-[#f8fafc] p-5 focus:bg-white focus:border-indigo-500 focus:ring-0 transition-all placeholder:text-slate-300 font-medium"
                                    placeholder="Enter your full delivery address..."></textarea>

                                @error('shipping_address')
                                    <p class="text-rose-500 text-xs mt-3 font-bold">
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>

                            <div>
                                <label class="block text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-4">
                                    Payment Method
                                </label>

                                <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">
                                    @foreach([
                                        'CashOnDelivery' => 'Cash',
                                        'KBZPay' => 'KBZPay',
                                        'WavePay' => 'WavePay',
                                        'BankTransfer' => 'Bank'
                                    ] as $val => $label)

                                        <label class="group cursor-pointer">
                                            <input type="radio"
                                                wire:model="payment_method"
                                                value="{{ $val }}"
                                                class="peer hidden">

                                            <div class="h-20 flex flex-col items-center justify-center rounded-3xl border-2 border-slate-100 bg-[#f8fafc] text-slate-400 group-hover:border-slate-300 peer-checked:border-slate-900 peer-checked:bg-slate-900 peer-checked:text-white transition-all duration-300">
                                                <span class="text-xs font-black uppercase tracking-tighter">
                                                    {{ $label }}
                                                </span>
                                            </div>
                                        </label>

                                    @endforeach
                                </div>

                                @error('payment_method')
                                    <p class="text-rose-500 text-xs mt-3 font-bold">
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>
                        </div>
                    </section>

                </div>

                {{-- Summary --}}
                <aside class="lg:col-span-4 lg:sticky lg:top-28">
                    <div class="bg-slate-900 rounded-[2.5rem] p-8 shadow-2xl shadow-slate-300 text-white overflow-hidden relative">

                        <div class="absolute -right-10 -top-10 h-40 w-40 rounded-full bg-indigo-500/20 blur-3xl"></div>

                        <div class="relative">
                            <p class="text-xs font-black uppercase tracking-[0.2em] text-indigo-200">
                                Order Summary
                            </p>

                            <h2 class="mt-3 text-3xl font-black">
                                Total Amount
                            </h2>

                            <div class="mt-8 space-y-5">
                                <div class="flex justify-between text-sm">
                                    <span class="text-slate-300">Items</span>
                                    <span class="font-bold">{{ $itemCount }}</span>
                                </div>

                                <div class="flex justify-between text-sm">
                                    <span class="text-slate-300">Subtotal</span>
                                    <span class="font-bold">${{ number_format($subtotal, 2) }}</span>
                                </div>

                                <div class="flex justify-between text-sm">
                                    <span class="text-slate-300">Shipping</span>
                                    <span class="font-bold text-emerald-300">Free</span>
                                </div>

                                <div class="border-t border-white/10 pt-6">
                                    <div class="flex justify-between items-end">
                                        <span class="text-sm font-black uppercase tracking-widest text-slate-300">
                                            Total
                                        </span>

                                        <span class="text-4xl font-black tracking-tight">
                                            ${{ number_format($subtotal, 2) }}
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <button wire:click="checkout"
                                class="mt-8 w-full rounded-3xl bg-white px-6 py-5 text-slate-900 font-black hover:bg-indigo-50 transition-all shadow-xl">
                                Confirm Order →
                            </button>

                            <div class="mt-8 grid grid-cols-2 gap-3">
                                <div class="rounded-2xl bg-white/10 p-4">
                                    <p class="text-[10px] font-black uppercase tracking-widest text-slate-300">
                                        Buyer Protection
                                    </p>
                                </div>

                                <div class="rounded-2xl bg-white/10 p-4">
                                    <p class="text-[10px] font-black uppercase tracking-widest text-slate-300">
                                        Verified Sellers
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </aside>

            </div>

        @endif

    </div>
</div>