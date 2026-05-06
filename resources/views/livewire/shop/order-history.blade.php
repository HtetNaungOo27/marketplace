<div class="min-h-screen bg-[#f8fafc] py-12">
    <div class="max-w-5xl mx-auto px-6">

        <div class="flex items-center justify-between mb-10">
            <div>
                <h1 class="text-4xl font-black text-slate-900 tracking-tight">Order History</h1>
                <p class="text-slate-500 mt-2 font-medium">Manage and track your recent purchases</p>
            </div>
            <div class="hidden sm:block">
                <span class="bg-white border border-slate-200 px-4 py-2 rounded-xl text-sm font-bold text-slate-700 shadow-sm">
                    {{ $orders->count() }} Total Orders
                </span>
            </div>
        </div>

        @if($orders->isEmpty())
        <div class="flex flex-col items-center justify-center py-32 bg-white rounded-[2.5rem] border border-dashed border-slate-200 shadow-sm">
            <div class="h-20 w-20 bg-slate-50 rounded-full flex items-center justify-center mb-6">
                <svg class="w-10 h-10 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/></svg>
            </div>
            <h2 class="text-xl font-bold text-slate-900">Your bag is empty</h2>
            <p class="text-slate-500 mt-2">Time to discover something new.</p>
            <a href="/" class="mt-8 bg-indigo-600 text-white px-8 py-3 rounded-2xl font-bold hover:bg-indigo-700 transition shadow-lg shadow-indigo-100">Start Shopping</a>
        </div>
        @else

        <div class="space-y-8">
            @foreach($orders as $order)
            <div class="group bg-white rounded-[2rem] border border-slate-200 shadow-sm hover:shadow-xl hover:shadow-slate-200/50 transition-all duration-300 overflow-hidden">
                
                <!-- Order Card Header -->
                <div class="bg-slate-50/50 px-8 py-6 border-b border-slate-100 flex flex-wrap justify-between items-center gap-4">
                    <div class="flex items-center gap-6">
                        <div>
                            <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Reference</p>
                            <p class="text-sm font-bold text-slate-900">#{{ $order->id }}</p>
                        </div>
                        <div>
                            <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Placed On</p>
                            <p class="text-sm font-bold text-slate-900">{{ \Carbon\Carbon::parse($order->order_date)->format('M d, Y') }}</p>
                        </div>
                    </div>

                    <div class="flex items-center gap-4">
                        <span class="inline-flex items-center px-4 py-1.5 rounded-full text-xs font-bold uppercase tracking-tighter
                            @if($order->order_status === 'Pending') bg-amber-50 text-amber-600 border border-amber-100
                            @elseif($order->order_status === 'Delivered') bg-emerald-50 text-emerald-600 border border-emerald-100
                            @else bg-slate-100 text-slate-600 border border-slate-200
                            @endif">
                            <span class="h-1.5 w-1.5 rounded-full mr-2 
                                @if($order->order_status === 'Pending') bg-amber-400
                                @elseif($order->order_status === 'Delivered') bg-emerald-400
                                @else bg-slate-400 @endif">
                            </span>
                            {{ $order->order_status }}
                        </span>
                        <a href="#" class="text-slate-400 hover:text-indigo-600 transition">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                        </a>
                    </div>
                </div>

                <!-- Product Content -->
                <div class="p-8">
                    <div class="divide-y divide-slate-100">
                        @foreach($order->items as $item)
                        <div class="py-4 first:pt-0 last:pb-0 flex items-center justify-between gap-6">
                            <div class="flex items-center gap-4">
                                @if($item->product->image)
                                <img src="{{ asset('storage/' . $item->product->image) }}" class="w-16 h-16 object-cover rounded-2xl shadow-sm border border-slate-100">
                                @else
                                <div class="w-16 h-16 bg-slate-50 rounded-2xl flex items-center justify-center text-slate-300">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                </div>
                                @endif
                                <div>
                                    <h4 class="font-bold text-slate-900">{{ $item->product->product_name }}</h4>
                                    <p class="text-sm text-slate-500 font-medium">Quantity: {{ $item->quantity }}</p>
                                </div>
                            </div>
                            <p class="font-bold text-slate-900">${{ number_format($item->subtotal, 2) }}</p>
                        </div>
                        @endforeach
                    </div>

                    <!-- Footer: Shipping & Total -->
                    <div class="mt-8 pt-8 border-t border-slate-100 flex flex-col md:flex-row md:items-end justify-between gap-6">
                        <div>
                            @if($order->delivery)
                            <div class="inline-flex flex-col bg-slate-50 rounded-2xl p-4 border border-slate-100">
                                <span class="text-[9px] font-black text-slate-400 uppercase tracking-widest mb-1">Shipping Info</span>
                                <p class="text-sm font-bold text-slate-700">{{ $order->delivery->delivery_status }}</p>
                                <p class="text-xs text-indigo-600 font-medium mt-1">Track: {{ $order->delivery->tracking_number }}</p>
                            </div>
                            @else
                            <p class="text-xs font-bold text-slate-400 uppercase tracking-widest">Processing Shipment...</p>
                            @endif
                        </div>

                        <div class="text-right">
                            <span class="text-[10px] font-black text-slate-400 uppercase tracking-widest block mb-1">Amount Paid</span>
                            <span class="text-3xl font-black text-slate-900">${{ number_format($order->total_amount, 2) }}</span>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @endif
    </div>
</div>