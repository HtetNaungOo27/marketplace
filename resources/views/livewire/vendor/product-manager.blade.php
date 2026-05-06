<div class="min-h-screen bg-[#f8fafc] pb-24">
    <div class="max-w-7xl mx-auto px-6 pt-12 space-y-10">

        <!-- Header -->
        <div class="flex flex-col md:flex-row md:items-end justify-between gap-6">
            <div>
                <h1 class="text-4xl font-black text-slate-900 tracking-tight">Product Studio</h1>
                <p class="text-slate-500 mt-2 font-medium">Create and refine your marketplace offerings with ease.</p>
            </div>
            @if($editing)
            <button wire:click="resetForm" class="text-xs font-black text-rose-500 uppercase tracking-widest hover:bg-rose-50 px-4 py-2 rounded-xl transition">
                Discard Changes
            </button>
            @endif
        </div>

        @if(session()->has('message'))
        <div class="fixed bottom-10 left-1/2 -translate-x-1/2 z-50 animate-ant-entrance">
            <div class="bg-slate-900 text-white px-8 py-4 rounded-[2rem] shadow-2xl flex items-center gap-4">
                <div class="h-6 w-6 bg-emerald-500 rounded-full flex items-center justify-center">
                    <svg class="w-3 h-3 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg>
                </div>
                <span class="text-sm font-bold">{{ session('message') }}</span>
            </div>
        </div>
        @endif

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-start">

            <!-- Sticky Editor Sidebar -->
            <div class="lg:col-span-4 sticky top-12">
                <div class="bg-white rounded-[2.5rem] border border-slate-200 shadow-sm overflow-hidden transition-all duration-500 {{ $editing ? 'ring-2 ring-indigo-500 ring-offset-4' : '' }}">
                    <div class="p-8 border-b border-slate-100 bg-slate-50/50">
                        <h2 class="text-xl font-black text-slate-900 uppercase tracking-tight">
                            {{ $editing ? 'Refine Product' : 'New Listing' }}
                        </h2>
                    </div>

                    <form wire:submit.prevent="saveProduct" class="p-8 space-y-6">
                        <div class="space-y-4">
                            <div>
                                <label class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-2 block ml-1">Identity</label>
                                <input type="text" wire:model="product_name"
                                    class="w-full rounded-2xl border-slate-200 bg-slate-50 focus:bg-white focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 transition-all placeholder:text-slate-300 font-bold p-4"
                                    placeholder="Product Title">
                            </div>

                            <div>
                                <label class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-2 block ml-1">Story</label>
                                <textarea wire:model="description" rows="3"
                                    class="w-full rounded-2xl border-slate-200 bg-slate-50 focus:bg-white focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 transition-all placeholder:text-slate-300 font-medium p-4 text-sm"
                                    placeholder="Briefly describe the features..."></textarea>
                            </div>

                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <label class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-2 block ml-1">Price ($)</label>
                                    <input type="number" step="0.01" wire:model="price"
                                        class="w-full rounded-2xl border-slate-200 bg-slate-50 focus:bg-white focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 transition-all font-bold p-4"
                                        placeholder="0.00">
                                </div>
                                <div>
                                    <label class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-2 block ml-1">Units</label>
                                    <input type="number" wire:model="stock_quantity"
                                        class="w-full rounded-2xl border-slate-200 bg-slate-50 focus:bg-white focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 transition-all font-bold p-4"
                                        placeholder="0">
                                </div>
                            </div>

                            <div class="grid grid-cols-2 gap-4">
                                <div class="col-span-2">
                                    <label class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-2 block ml-1">Classification</label>
                                    <select wire:model="category_id"
                                        class="w-full rounded-2xl border-slate-200 bg-slate-50 focus:bg-white focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 transition-all font-bold p-4 appearance-none cursor-pointer">
                                        <option value="">Choose Category</option>
                                        @foreach($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div>
                                <label class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-2 block ml-1">Visual Media</label>
                                <div class="relative group/upload">
                                    <input type="file" wire:model="image" class="absolute inset-0 w-full h-full opacity-0 z-10 cursor-pointer">
                                    <div class="border-2 border-dashed border-slate-200 rounded-2xl p-6 text-center group-hover/upload:border-indigo-400 group-hover/upload:bg-indigo-50/30 transition-all">
                                        <svg class="w-6 h-6 text-slate-400 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                        <span class="text-xs font-bold text-slate-500 tracking-tight">Drop file or <span class="text-indigo-600">click here</span></span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <button type="submit"
                            class="w-full rounded-2xl bg-slate-900 px-4 py-5 text-white font-black uppercase tracking-widest text-xs shadow-xl shadow-slate-200 hover:bg-indigo-600 transition-all transform active:scale-[0.98]">
                            {{ $editing ? 'Save Updates' : 'Launch Listing' }}
                        </button>
                    </form>
                </div>
            </div>

            <!-- Product Gallery -->
            <div class="lg:col-span-8">
                <div class="flex items-center justify-between mb-8 px-2">
                    <h2 class="text-xs font-black text-slate-400 uppercase tracking-[0.3em]">Current Inventory ({{ $products->count() }})</h2>
                </div>

                @if($products->count() === 0)
                <div class="bg-white rounded-[3rem] border border-dashed border-slate-200 p-32 text-center">
                    <p class="text-slate-400 font-bold text-lg">Your inventory is empty.</p>
                    <p class="text-slate-300 text-sm mt-1">Start by filling out the form on the left.</p>
                </div>
                @else
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    @foreach($products as $product)
                    <div class="group bg-white rounded-[2.5rem] border border-slate-100 shadow-sm hover:shadow-2xl hover:shadow-slate-200/50 transition-all duration-500 overflow-hidden relative">
                        
                        <!-- Stock Status Pip -->
                        <div class="absolute top-4 right-4 z-10">
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-[9px] font-black uppercase tracking-widest {{ $product->status === 'Available' ? 'bg-emerald-50 text-emerald-600 border border-emerald-100' : 'bg-rose-50 text-rose-600 border border-rose-100' }}">
                                {{ $product->status }}
                            </span>
                        </div>

                        <div class="aspect-[4/3] overflow-hidden relative">
                            @if($product->image)
                            <img src="{{ asset('storage/' . $product->image) }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                            @else
                            <div class="w-full h-full bg-slate-50 flex items-center justify-center text-slate-200">
                                <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                            </div>
                            @endif
                            <!-- Gradient Overlay -->
                            <div class="absolute inset-0 bg-gradient-to-t from-slate-900/60 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity"></div>
                        </div>

                        <div class="p-8">
                            <div class="mb-4">
                                <span class="text-[9px] font-black text-indigo-500 uppercase tracking-widest">{{ $product->category->category_name ?? 'Uncategorized' }}</span>
                                <h3 class="text-xl font-black text-slate-900 tracking-tight leading-tight mt-1">{{ $product->product_name }}</h3>
                            </div>

                            <div class="flex items-end justify-between border-t border-slate-50 pt-6">
                                <div>
                                    <p class="text-[9px] font-black text-slate-400 uppercase tracking-widest">Pricing & Stock</p>
                                    <p class="text-2xl font-black text-slate-900 mt-1">${{ number_format($product->price, 2) }}</p>
                                    <p class="text-xs font-bold text-slate-500">{{ $product->stock_quantity }} units in vault</p>
                                </div>

                                <div class="flex gap-2">
                                    <button wire:click="editProduct({{ $product->id }})"
                                        class="h-12 w-12 rounded-2xl bg-indigo-50 text-indigo-600 flex items-center justify-center hover:bg-indigo-600 hover:text-white transition-all shadow-sm">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                    </button>

                                    <button wire:click="deleteProduct({{ $product->id }})"
                                        onclick="return confirm('Archive this listing?')"
                                        class="h-12 w-12 rounded-2xl bg-rose-50 text-rose-500 flex items-center justify-center hover:bg-rose-500 hover:text-white transition-all shadow-sm">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                @endif
            </div>

        </div>
    </div>
</div>