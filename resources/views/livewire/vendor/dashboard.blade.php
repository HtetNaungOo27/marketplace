<div class="min-h-screen bg-[#f8fafc] pb-20">
    <div class="max-w-7xl mx-auto px-6 pt-12 space-y-10">

        <!-- Header & Store Identity -->
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-6">
            <div>
                <h1 class="text-4xl font-black text-slate-900 tracking-tight">Dashboard</h1>
                <p class="text-slate-500 mt-1 font-medium">Hello, {{ auth()->user()->name }}. Here's what's happening with your store today.</p>
            </div>
            <a
                href="/vendor/products"
                class="inline-flex items-center px-6 py-3 rounded-2xl bg-slate-900 text-white font-bold text-sm shadow-xl shadow-slate-200 hover:bg-indigo-600 transition-all transform active:scale-[0.98]">

                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4" />
                </svg>

                Add New Product
            </a>
        </div>

        <!-- Store Hero Card -->
        <div class="relative overflow-hidden rounded-[2.5rem] bg-slate-900 p-10 text-white shadow-2xl shadow-indigo-900/20">
            <!-- Decorative Background Swirl -->
            <div class="absolute top-0 right-0 -mr-16 -mt-16 h-64 w-64 rounded-full bg-indigo-500/20 blur-3xl"></div>

            <div class="relative z-10 flex flex-col md:flex-row md:items-center justify-between gap-8">
                <div>
                    <span class="text-[10px] font-black text-indigo-300 uppercase tracking-[0.2em]">Storefront</span>
                    <h2 class="text-4xl font-black mt-1">{{ $vendor->store_name }}</h2>
                    <div class="mt-4 flex items-center gap-3">
                        <span class="inline-flex items-center px-3 py-1 rounded-full bg-white/10 border border-white/10 text-xs font-bold tracking-tight">
                            <span class="h-2 w-2 rounded-full bg-emerald-400 mr-2 animate-pulse"></span>
                            {{ $vendor->approval_status }}
                        </span>
                    </div>
                </div>

                <div class="flex gap-6 border-l border-white/10 pl-8">
                    <div class="text-center">
                        <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Global Rank</p>
                        <p class="text-2xl font-bold mt-1">#124</p>
                    </div>
                    <div class="text-center">
                        <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Rating</p>
                        <p class="text-2xl font-bold mt-1 text-amber-400">4.9★</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Metric Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            <div class="group rounded-3xl bg-white border border-slate-200 p-8 shadow-sm hover:border-indigo-100 transition-all">
                <div class="flex items-center justify-between mb-4">
                    <div class="p-2 bg-slate-50 rounded-xl group-hover:bg-indigo-50 transition-colors">
                        <svg class="w-6 h-6 text-slate-400 group-hover:text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                        </svg>
                    </div>
                    <span class="text-xs font-bold text-emerald-500">+12%</span>
                </div>
                <p class="text-xs font-black text-slate-400 uppercase tracking-widest">Active Products</p>
                <p class="mt-1 text-3xl font-black text-slate-900">{{ $productsCount }}</p>
            </div>

            <div class="group rounded-3xl bg-white border border-slate-200 p-8 shadow-sm hover:border-indigo-100 transition-all">
                <div class="flex items-center justify-between mb-4">
                    <div class="p-2 bg-slate-50 rounded-xl group-hover:bg-indigo-50 transition-colors">
                        <svg class="w-6 h-6 text-slate-400 group-hover:text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                        </svg>
                    </div>
                    <span class="text-xs font-bold text-emerald-500">+5%</span>
                </div>
                <p class="text-xs font-black text-slate-400 uppercase tracking-widest">Total Sales</p>
                <p class="mt-1 text-3xl font-black text-slate-900">{{ $ordersCount }}</p>
            </div>

            <div class="group rounded-3xl bg-white border border-slate-200 p-8 shadow-sm hover:border-indigo-100 transition-all">
                <div class="flex items-center justify-between mb-4">
                    <div class="p-2 bg-amber-50 rounded-xl">
                        <svg class="w-6 h-6 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <span class="text-xs font-bold text-amber-500">Action Required</span>
                </div>
                <p class="text-xs font-black text-slate-400 uppercase tracking-widest">Pending Shipments</p>
                <p class="mt-1 text-3xl font-black text-slate-900">{{ $pendingOrders }}</p>
            </div>

            <div class="group rounded-3xl bg-white border border-indigo-600 p-8 shadow-xl shadow-indigo-100 transition-all">
                <div class="flex items-center justify-between mb-4">
                    <div class="p-2 bg-indigo-600 rounded-xl">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                </div>
                <p class="text-xs font-black text-indigo-400 uppercase tracking-widest">Available for Payout</p>
                <p class="mt-1 text-3xl font-black text-indigo-600">
                    ${{ number_format($pendingPayout, 2) }}
                </p>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
            <!-- Recent Activity Table -->
            <div class="lg:col-span-8 bg-white rounded-[2rem] border border-slate-200 shadow-sm overflow-hidden">
                <div class="p-8 border-b border-slate-100 flex items-center justify-between">
                    <h2 class="text-xl font-bold text-slate-900">Recent Transactions</h2>
                    <a href="/vendor/orders" class="text-xs font-black text-indigo-600 uppercase tracking-widest hover:text-indigo-700">View Full History &rarr;</a>
                </div>

                @if($recentOrders->isEmpty())
                <div class="p-20 text-center">
                    <p class="text-slate-400 font-medium">Waiting for your first order...</p>
                </div>
                @else
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-slate-50/50">
                                <th class="px-8 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest">Order</th>
                                <th class="px-8 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest">Customer</th>
                                <th class="px-8 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest">Status</th>
                                <th class="px-8 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest text-right">Payment</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100">
                            @foreach($recentOrders as $order)
                            <tr class="hover:bg-slate-50/50 transition-colors">
                                <td class="px-8 py-6 font-bold text-slate-900">#{{ $order->id }}</td>
                                <td class="px-8 py-6 text-slate-600 font-medium">{{ $order->customer->user->name ?? 'Guest User' }}</td>
                                <td class="px-8 py-6">
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-[10px] font-bold uppercase tracking-tight
                                            @if($order->order_status === 'Pending') bg-amber-50 text-amber-600
                                            @elseif($order->order_status === 'Delivered') bg-emerald-50 text-emerald-600
                                            @else bg-slate-100 text-slate-500
                                            @endif">
                                        {{ $order->order_status }}
                                    </span>
                                </td>
                                <td class="px-8 py-6 text-right font-medium text-slate-500 text-sm">
                                    {{ $order->payment->payment_method ?? 'Bank' }}
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @endif
            </div>

            <!-- Earnings Breakdown Sidebar -->
            <div class="lg:col-span-4 space-y-6">
                <div class="bg-white rounded-[2rem] border border-slate-200 p-8 shadow-sm">
                    <h2 class="text-xl font-bold text-slate-900 mb-6">Financial Summary</h2>

                    <div class="space-y-6">
                        <div class="flex items-center justify-between p-4 bg-slate-50 rounded-2xl">
                            <div>
                                <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Pending Payout</p>
                                <p class="text-xl font-black text-amber-600">${{ number_format($pendingPayout, 2) }}</p>
                            </div>
                            <svg class="w-8 h-8 text-amber-200" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd" />
                            </svg>
                        </div>

                        <div class="flex items-center justify-between p-4 bg-emerald-50 rounded-2xl">
                            <div>
                                <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Total Released</p>
                                <p class="text-xl font-black text-emerald-600">${{ number_format($releasedPayout, 2) }}</p>
                            </div>
                            <svg class="w-8 h-8 text-emerald-200" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                            </svg>
                        </div>

                        <a href="/vendor/payouts" class="block w-full py-4 text-center bg-indigo-600 text-white rounded-2xl font-bold shadow-lg shadow-indigo-100 hover:bg-indigo-700 transition-all">
                            Request Withdrawal
                        </a>
                    </div>
                </div>

                <!-- Mini Tip Card -->
                <div class="bg-indigo-600 rounded-[2rem] p-8 text-white">
                    <p class="text-xs font-black text-indigo-200 uppercase tracking-widest mb-2">Pro Tip</p>
                    <p class="font-bold leading-relaxed">Vendors who upload more than 10 products see a 40% increase in sales. Time to expand?</p>
                </div>
            </div>
        </div>

    </div>
</div>