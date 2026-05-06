<div class="min-h-screen bg-[#fcfcfd] flex items-center justify-center py-12 px-6">
    <div class="max-w-xl w-full">
        <!-- Main Card -->
        <div class="bg-white rounded-[3rem] shadow-[0_20px_50px_rgba(79,70,229,0.05)] border border-slate-100 overflow-hidden">
            
            <!-- Top Accent Pattern -->
            <div class="h-3 bg-gradient-to-r from-indigo-500 via-purple-500 to-pink-500"></div>

            <div class="p-10 md:p-14 text-center">
                <!-- Animated Success Badge -->
                <div class="relative mx-auto h-24 w-24 mb-8">
                    <div class="absolute inset-0 rounded-full bg-emerald-100 animate-ping opacity-20"></div>
                    <div class="relative h-24 w-24 rounded-full bg-emerald-500 flex items-center justify-center text-white shadow-lg shadow-emerald-200">
                        <svg class="h-12 w-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path>
                        </svg>
                    </div>
                </div>

                <h1 class="text-4xl font-black text-slate-900 tracking-tight">
                    It's Official!
                </h1>

                <p class="mt-3 text-lg text-slate-500 font-medium">
                    Order <span class="text-indigo-600">#{{ $order->id }}</span> is in the works.
                </p>

                <!-- Status Pill -->
                <div class="mt-6 inline-flex items-center px-4 py-1.5 rounded-full bg-slate-50 border border-slate-100">
                    <span class="flex h-2 w-2 rounded-full bg-amber-400 mr-2"></span>
                    <span class="text-xs font-bold text-slate-600 uppercase tracking-widest">{{ $order->order_status }}</span>
                </div>

                <!-- Receipt Detail -->
                <div class="mt-10 text-left">
                    <div class="rounded-[2rem] bg-slate-50/50 border border-slate-100 p-8">
                        <h3 class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-6">Order Summary</h3>
                        
                        <div class="space-y-4">
                            <div class="flex justify-between items-center">
                                <span class="text-slate-500 font-medium text-sm">Payment Method</span>
                                <div class="text-right">
                                    <p class="text-sm font-bold text-slate-900">{{ $order->payment->payment_method ?? 'Not Specified' }}</p>
                                    <p class="text-[10px] font-bold text-emerald-500 uppercase tracking-tight">{{ $order->payment->payment_status ?? 'Pending' }}</p>
                                </div>
                            </div>

                            <div class="pt-4 border-t border-slate-200/60 flex justify-between items-center">
                                <span class="text-slate-900 font-bold">Total Amount Paid</span>
                                <span class="text-2xl font-black text-slate-900 leading-none">
                                    ${{ number_format($order->total_amount, 2) }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Actions -->
                <div class="mt-10 flex flex-col sm:flex-row gap-4">
                    <a href="/orders"
                       class="flex-1 rounded-2xl bg-slate-900 px-8 py-4 text-white font-bold shadow-xl shadow-slate-200 hover:bg-indigo-600 transition-all transform active:scale-95 text-center">
                        TRACK ORDER
                    </a>

                    <a href="/"
                       class="flex-1 rounded-2xl border-2 border-slate-100 bg-white px-8 py-4 text-slate-600 font-bold hover:border-slate-300 transition-all text-center">
                        GO SHOPPING
                    </a>
                </div>

                <p class="mt-8 text-sm text-slate-400">
                    A confirmation email has been sent to your inbox.
                </p>
            </div>
        </div>
        
        <!-- Helpful Links -->
        <div class="mt-8 flex justify-center gap-8">
            <a href="#" class="text-xs font-bold text-slate-400 hover:text-slate-600 uppercase tracking-widest">Support</a>
            <a href="#" class="text-xs font-bold text-slate-400 hover:text-slate-600 uppercase tracking-widest">Shipping Policy</a>
            <a href="#" class="text-xs font-bold text-slate-400 hover:text-slate-600 uppercase tracking-widest">Contact Vendor</a>
        </div>
    </div>
</div>