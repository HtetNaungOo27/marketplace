<div class="min-h-screen bg-[#f8fafc] pb-24">
    <div class="max-w-6xl mx-auto px-6 py-12">
        
        <!-- Header Section -->
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-6 mb-10">
            <div>
                <h1 class="text-4xl font-black text-slate-900 tracking-tight">Payout Ledger</h1>
                <p class="text-slate-500 mt-2 font-medium">Track your earnings, platform fees, and scheduled transfers.</p>
            </div>
            <button class="inline-flex items-center px-6 py-3 rounded-2xl bg-white border border-slate-200 text-slate-700 font-bold text-sm shadow-sm hover:bg-slate-50 transition-all">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                Export CSV
            </button>
        </div>

        <!-- Financial Overview Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-12">
            <div class="relative overflow-hidden bg-white rounded-[2.5rem] border border-slate-200 p-8 shadow-sm group">
                <div class="absolute -right-4 -top-4 h-24 w-24 rounded-full bg-amber-50 group-hover:scale-150 transition-transform duration-500"></div>
                <div class="relative">
                    <p class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-1">Incoming Balance</p>
                    <h2 class="text-4xl font-black text-slate-900">${{ number_format($totalPending, 2) }}</h2>
                    <div class="mt-4 flex items-center text-amber-600 gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        <span class="text-xs font-bold uppercase tracking-tight">Awaiting verification</span>
                    </div>
                </div>
            </div>

            <div class="relative overflow-hidden bg-slate-900 rounded-[2.5rem] p-8 shadow-xl shadow-slate-200 group">
                <div class="absolute -right-4 -top-4 h-24 w-24 rounded-full bg-indigo-500/10 group-hover:scale-150 transition-transform duration-500"></div>
                <div class="relative">
                    <p class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-1">Total Withdrawn</p>
                    <h2 class="text-4xl font-black text-white">${{ number_format($totalReleased, 2) }}</h2>
                    <div class="mt-4 flex items-center text-emerald-400 gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        <span class="text-xs font-bold uppercase tracking-tight">Funds successfully settled</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Payout History Table -->
        <div class="bg-white rounded-[2rem] border border-slate-200 shadow-sm overflow-hidden">
            <div class="px-8 py-6 border-b border-slate-100 flex items-center justify-between bg-slate-50/30">
                <h3 class="text-xs font-black text-slate-400 uppercase tracking-[0.2em]">Transaction Breakdown</h3>
                <span class="text-[10px] font-bold px-3 py-1 bg-slate-100 rounded-full text-slate-500">Showing all activity</span>
            </div>

            @if($payouts->isEmpty())
                <div class="p-20 text-center">
                    <div class="w-16 h-16 bg-slate-50 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-slate-200" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z"/></svg>
                    </div>
                    <p class="text-slate-400 font-medium tracking-tight">No financial records found.</p>
                </div>
            @else
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead>
                            <tr class="text-left border-b border-slate-100">
                                <th class="px-8 py-5 text-[10px] font-black text-slate-400 uppercase tracking-widest">Order Reference</th>
                                <th class="px-8 py-5 text-[10px] font-black text-slate-400 uppercase tracking-widest">Gross Sales</th>
                                <th class="px-8 py-5 text-[10px] font-black text-slate-400 uppercase tracking-widest">Platform Fee</th>
                                <th class="px-8 py-5 text-[10px] font-black text-slate-400 uppercase tracking-widest">Net Revenue</th>
                                <th class="px-8 py-5 text-[10px] font-black text-slate-400 uppercase tracking-widest text-right">Settlement</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100">
                            @foreach($payouts as $payout)
                                <tr class="group hover:bg-slate-50/50 transition-colors">
                                    <td class="px-8 py-6">
                                        <div class="flex items-center gap-3">
                                            <div class="h-8 w-8 bg-slate-100 rounded-lg flex items-center justify-center text-slate-500 font-bold text-xs">#</div>
                                            <span class="font-bold text-slate-900">{{ $payout->order_id }}</span>
                                        </div>
                                    </td>
                                    <td class="px-8 py-6">
                                        <span class="text-sm font-medium text-slate-600">${{ number_format($payout->gross_amount, 2) }}</span>
                                    </td>
                                    <td class="px-8 py-6">
                                        <div class="flex flex-col">
                                            <span class="text-sm font-bold text-rose-500">-${{ number_format($payout->commission_amount, 2) }}</span>
                                            <span class="text-[9px] font-black text-slate-300 uppercase tracking-tighter">{{ $payout->commission_rate }}% Service Fee</span>
                                        </div>
                                    </td>
                                    <td class="px-8 py-6">
                                        <span class="text-lg font-black text-slate-900">${{ number_format($payout->net_amount, 2) }}</span>
                                    </td>
                                    <td class="px-8 py-6 text-right">
                                        <span class="inline-flex items-center px-4 py-1.5 rounded-full text-[10px] font-black uppercase tracking-widest
                                            {{ $payout->payout_status === 'Released'
                                                ? 'bg-emerald-50 text-emerald-600 border border-emerald-100'
                                                : 'bg-amber-50 text-amber-600 border border-amber-100' }}">
                                            {{ $payout->payout_status }}
                                        </span>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>

        <!-- Footer Help -->
        <div class="mt-8 flex items-center gap-4 p-6 bg-slate-100 rounded-3xl border border-slate-200 border-dashed">
            <div class="h-10 w-10 bg-white rounded-xl flex items-center justify-center text-slate-400 shadow-sm">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            </div>
            <p class="text-sm text-slate-500 font-medium">
                Pendants/Pending payouts are typically settled within 3-5 business days after order delivery. 
                <a href="#" class="text-indigo-600 font-bold hover:underline">Learn more about our payout cycles.</a>
            </p>
        </div>
    </div>
</div>