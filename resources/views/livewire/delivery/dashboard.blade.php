<div class="min-h-screen bg-[#f8fafc] pb-24">
    <div class="max-w-4xl mx-auto px-6 py-12">

        <!-- Header with Marketplace Brand -->
        <div class="flex items-center gap-4 mb-10">
            <div class="h-12 w-12 bg-indigo-600 rounded-2xl shadow-lg shadow-indigo-200 flex items-center justify-center text-white transform -rotate-6">
                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                </svg>
            </div>
            <div>
                <h1 class="text-3xl font-black text-slate-900 tracking-tight uppercase">Fleet<span class="text-indigo-600">Ops</span></h1>
                <p class="text-slate-500 font-medium">Logistics & Delivery Management</p>
            </div>
        </div>

        @if(session()->has('message'))
        <div class="mb-8 animate-in fade-in slide-in-from-top-4 duration-300">
            <div class="bg-slate-900 text-white px-6 py-4 rounded-[2rem] shadow-2xl flex items-center gap-3">
                <div class="bg-emerald-500 rounded-full p-1">
                    <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg>
                </div>
                <span class="text-sm font-bold">{{ session('message') }}</span>
            </div>
        </div>
        @endif

        @if($deliveries->count() === 0)
        <div class="bg-white rounded-[3rem] border border-dashed border-slate-200 py-32 text-center">
            <div class="h-20 w-20 bg-slate-50 rounded-full flex items-center justify-center mx-auto mb-6">
                <svg class="w-10 h-10 text-slate-200" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4"/></svg>
            </div>
            <h2 class="text-xl font-bold text-slate-900">Manifest Clear</h2>
            <p class="text-slate-500 font-medium">No deliveries are currently assigned to your route.</p>
        </div>
        @else
            <div class="space-y-8">
                @foreach($deliveries as $delivery)
                    <div class="group bg-white rounded-[2.5rem] border border-slate-200 shadow-sm hover:shadow-xl hover:shadow-indigo-500/5 transition-all duration-500 overflow-hidden">
                        
                        <!-- Top Bar: Tracking & Status -->
                        <div class="px-8 py-6 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-6 border-b border-slate-50">
                            <div>
                                <span class="text-[10px] font-black text-indigo-500 uppercase tracking-[0.2em]">Live Tracking</span>
                                <h2 class="text-2xl font-black text-slate-900 mt-1 tracking-tight">
                                    {{ $delivery->tracking_number }}
                                </h2>
                            </div>

                            <div class="relative w-full sm:w-48">
                                <select
                                    wire:change="updateDeliveryStatus({{ $delivery->id }}, $event.target.value)"
                                    class="w-full pl-5 pr-10 py-3 bg-slate-50 border-none rounded-2xl text-sm font-bold text-slate-900 focus:ring-4 focus:ring-indigo-500/10 transition-all appearance-none cursor-pointer"
                                >
                                    <option value="Preparing" {{ $delivery->delivery_status === 'Preparing' ? 'selected' : '' }}>📦 Preparing</option>
                                    <option value="InTransit" {{ $delivery->delivery_status === 'InTransit' ? 'selected' : '' }}>🚚 In Transit</option>
                                    <option value="Delivered" {{ $delivery->delivery_status === 'Delivered' ? 'selected' : '' }}>✅ Delivered</option>
                                </select>
                                <div class="absolute right-4 top-1/2 -translate-y-1/2 pointer-events-none text-slate-400">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                                </div>
                            </div>
                        </div>

                        <!-- Card Body -->
                        <div class="p-8">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                                <!-- Customer Info -->
                                <div class="space-y-4">
                                    <div class="flex items-center gap-4">
                                        <div class="h-12 w-12 bg-slate-100 rounded-2xl flex items-center justify-center text-slate-500">
                                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                                        </div>
                                        <div>
                                            <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Recipient</p>
                                            <h3 class="font-bold text-slate-900">{{ $delivery->order->customer->user->name ?? 'Unknown' }}</h3>
                                            <p class="text-xs font-medium text-slate-500">Order #{{ $delivery->order_id }}</p>
                                        </div>
                                    </div>
                                </div>

                                <!-- Manifest Summary -->
                                <div class="bg-slate-50 rounded-3xl p-6">
                                    <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-4">Package Contents</p>
                                    <div class="space-y-3">
                                        @foreach($delivery->order->items as $item)
                                            <div class="flex justify-between items-center text-sm">
                                                <span class="font-bold text-slate-700">
                                                    <span class="text-indigo-600">{{ $item->quantity }}×</span> {{ $item->product->product_name ?? 'Product' }}
                                                </span>
                                                <span class="font-medium text-slate-400">${{ number_format($item->subtotal, 2) }}</span>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>

                            <!-- Footer Actions -->
                            <div class="mt-8 pt-6 border-t border-slate-50 flex justify-end">
                                <button class="px-6 py-3 bg-white border border-slate-200 rounded-xl text-sm font-bold text-slate-700 hover:bg-slate-50 transition-all flex items-center gap-2">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7"/></svg>
                                    View on Map
                                </button>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif

    </div>
</div>