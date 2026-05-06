<div class="min-h-screen bg-[#f8fafc] pb-24">
    <!-- Success Toast -->
    @if(session()->has('message'))
    <div class="fixed top-6 right-6 z-50 animate-bounce">
        <div class="bg-slate-900 text-white px-6 py-4 rounded-2xl shadow-2xl flex items-center gap-3">
            <div class="bg-emerald-500 rounded-full p-1">
                <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg>
            </div>
            <span class="text-sm font-bold">{{ session('message') }}</span>
        </div>
    </div>
    @endif

    <div class="max-w-5xl mx-auto px-6 py-12">
        <div class="flex flex-col md:flex-row md:items-end justify-between gap-6 mb-10">
            <div>
                <h1 class="text-4xl font-black text-slate-900 tracking-tight">Orders to Fulfill</h1>
                <p class="text-slate-500 mt-2 font-medium">Manage your shipping queue and update order progress.</p>
            </div>
            <div class="flex bg-white p-1 rounded-xl border border-slate-200 shadow-sm">
                <button class="px-4 py-2 text-xs font-black uppercase tracking-widest text-indigo-600 bg-indigo-50 rounded-lg">All Orders</button>
                <button class="px-4 py-2 text-xs font-black uppercase tracking-widest text-slate-400 hover:text-slate-600">Pending</button>
                <button class="px-4 py-2 text-xs font-black uppercase tracking-widest text-slate-400 hover:text-slate-600">Completed</button>
            </div>
        </div>

        @if($orders->count() === 0)
        <div class="bg-white rounded-[2.5rem] border border-dashed border-slate-300 py-32 text-center">
            <div class="h-20 w-20 bg-slate-50 rounded-full flex items-center justify-center mx-auto mb-6">
                <svg class="w-10 h-10 text-slate-200" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0a2 2 0 012 2v4a2 2 0 01-2 2H4a2 2 0 01-2-2v-4a2 2 0 012-2m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/></svg>
            </div>
            <h2 class="text-xl font-bold text-slate-900">Queue Clear</h2>
            <p class="text-slate-500 font-medium">You've processed all your current orders. Good work!</p>
        </div>
        @else

        <div class="space-y-8">
            @foreach($orders as $order)
            <div class="group bg-white rounded-[2rem] border border-slate-200 shadow-sm hover:shadow-xl hover:shadow-indigo-500/5 transition-all duration-300 overflow-hidden">
                
                <!-- Order Utility Bar -->
                <div class="bg-slate-50/50 px-8 py-4 border-b border-slate-100 flex justify-between items-center">
                    <span class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em]">Ref: #{{ $order->id }}</span>
                    <span class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em]">{{ \Carbon\Carbon::parse($order->created_at)->format('d M Y • h:i A') }}</span>
                </div>

                <div class="p-8">
                    <div class="flex flex-col lg:flex-row justify-between gap-10">
                        
                        <!-- Customer & Logistics Info -->
                        <div class="flex-1 space-y-6">
                            <div class="flex items-start gap-4">
                                <div class="h-12 w-12 bg-indigo-50 rounded-2xl flex items-center justify-center text-indigo-600 font-bold">
                                    {{ substr($order->customer->user->name ?? 'U', 0, 1) }}
                                </div>
                                <div>
                                    <h3 class="text-lg font-black text-slate-900">{{ $order->customer->user->name ?? 'Unknown Customer' }}</h3>
                                    <p class="text-sm font-medium text-slate-500">Method: {{ $order->payment->payment_method ?? 'Standard' }}</p>
                                </div>
                            </div>

                            <div class="flex gap-4">
                                <div class="px-4 py-2 bg-slate-50 rounded-xl border border-slate-100">
                                    <p class="text-[9px] font-black text-slate-400 uppercase tracking-widest mb-1">Payment Status</p>
                                    <span class="text-xs font-bold {{ optional($order->payment)->payment_status === 'Paid' ? 'text-emerald-600' : 'text-amber-600' }}">
                                        {{ $order->payment->payment_status ?? 'Pending' }}
                                    </span>
                                </div>
                                <div class="px-4 py-2 bg-slate-50 rounded-xl border border-slate-100">
                                    <p class="text-[9px] font-black text-slate-400 uppercase tracking-widest mb-1">Items for You</p>
                                    <span class="text-xs font-bold text-slate-900">
                                        {{ $order->items->where('product.vendor_id', auth()->user()->vendor->id)->count() }} Products
                                    </span>
                                </div>
                            </div>
                        </div>

                        <!-- Action Center -->
                        <div class="lg:w-72">
                            <label class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-3 block">Update Fulfillment</label>
                            <div class="relative">
                                <select wire:change="updateStatus({{ $order->id }}, $event.target.value)"
                                    class="w-full pl-4 pr-10 py-4 bg-white border-2 border-slate-100 rounded-2xl text-sm font-bold text-slate-900 focus:border-indigo-500 focus:ring-0 transition-all appearance-none cursor-pointer">
                                    <option value="Pending" {{ $order->order_status == 'Pending' ? 'selected' : '' }}>🕒 Set to Pending</option>
                                    <option value="Shipped" {{ $order->order_status == 'Shipped' ? 'selected' : '' }}>📦 Set to Shipped</option>
                                    <option value="Delivered" {{ $order->order_status == 'Delivered' ? 'selected' : '' }}>✅ Set to Delivered</option>
                                    <option value="Cancelled" {{ $order->order_status == 'Cancelled' ? 'selected' : '' }}>🚫 Cancel Order</option>
                                </select>
                                <div class="absolute right-4 top-1/2 -translate-y-1/2 pointer-events-none text-slate-400">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Itemized List (Vendor Only) -->
                    <div class="mt-10 pt-8 border-t border-slate-100">
                        <h4 class="text-[10px] font-black text-slate-300 uppercase tracking-[0.2em] mb-6">Manifest</h4>
                        <div class="space-y-4">
                            @foreach($order->items as $item)
                            @if($item->product->vendor_id == auth()->user()->vendor->id)
                            <div class="flex items-center gap-6 p-4 rounded-2xl hover:bg-slate-50 transition-colors group/item">
                                <div class="relative">
                                    <img src="{{ asset('storage/' . $item->product->image) }}" class="w-16 h-16 object-cover rounded-xl shadow-sm">
                                    <span class="absolute -top-2 -right-2 bg-slate-900 text-white text-[10px] font-bold h-5 w-5 flex items-center justify-center rounded-full border-2 border-white">
                                        {{ $item->quantity }}
                                    </span>
                                </div>

                                <div class="flex-1">
                                    <p class="font-bold text-slate-900 group-hover/item:text-indigo-600 transition-colors">
                                        {{ $item->product->product_name }}
                                    </p>
                                    <p class="text-xs font-medium text-slate-400">SKU: PROD-{{ $item->product->id }}</p>
                                </div>

                                <div class="text-right">
                                    <p class="font-black text-slate-900 text-lg">${{ number_format($item->subtotal, 2) }}</p>
                                </div>
                            </div>
                            @endif
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @endif
    </div>
</div>