<div class="min-h-screen bg-[#fcfcfd]">
    <nav class="max-w-7xl mx-auto px-6 py-8">
        <a href="/" class="group inline-flex items-center text-sm font-bold tracking-tight text-slate-400 hover:text-indigo-600 transition-colors">
            <svg class="w-5 h-5 mr-2 transform group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"/></svg>
            BACK TO COLLECTION
        </a>
    </nav>

    <section class="max-w-7xl mx-auto px-6 pb-20">
        @if(session()->has('message'))
        <div class="mb-8 flex items-center justify-between rounded-2xl bg-indigo-600 px-6 py-4 text-white shadow-xl shadow-indigo-200">
            <span class="font-medium">{{ session('message') }}</span>
            <button class="opacity-70 hover:opacity-100">✕</button>
        </div>
        @endif

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 xl:gap-20">
            <!-- Left: Gallery -->
            <div class="lg:col-span-7">
                <div class="sticky top-10 rounded-[2.5rem] bg-slate-100 border border-slate-200 shadow-sm overflow-hidden group">
                    @if($product->image)
                    <img src="{{ asset('storage/' . $product->image) }}" class="w-full aspect-[4/5] object-cover transition-transform duration-700 group-hover:scale-105">
                    @else
                    <div class="w-full aspect-[4/5] flex flex-col items-center justify-center text-slate-400">
                        <svg class="w-16 h-16 opacity-20 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                        <span class="font-medium uppercase tracking-widest text-xs">No image preview available</span>
                    </div>
                    @endif
                </div>
            </div>

            <!-- Right: Product Info -->
            <div class="lg:col-span-5 flex flex-col justify-center">
                <div class="space-y-8">
                    <div>
                        <div class="flex items-center gap-3 mb-4">
                            <span class="px-3 py-1 rounded-full bg-indigo-50 text-indigo-600 text-[10px] font-black uppercase tracking-widest border border-indigo-100">
                                {{ $product->category->category_name ?? 'Collection' }}
                            </span>
                            <span class="text-xs font-bold {{ $product->status === 'Available' ? 'text-emerald-500' : 'text-rose-500' }}">
                                ● {{ $product->status }}
                            </span>
                        </div>
                        
                        <h1 class="text-5xl font-black text-slate-900 tracking-tight leading-none mb-4">
                            {{ $product->product_name }}
                        </h1>
                        
                        <div class="flex items-center gap-2 text-slate-500">
                            <span class="text-sm">Curated by</span>
                            <a href="#" class="text-sm font-bold text-slate-900 underline decoration-indigo-200 hover:decoration-indigo-500 transition-all underline-offset-4">
                                {{ $product->vendor->store_name ?? 'Local Vendor' }}
                            </a>
                        </div>
                    </div>

                    <div class="flex items-baseline gap-4">
                        <span class="text-5xl font-black text-slate-900">${{ number_format($product->price, 2) }}</span>
                        <span class="text-slate-400 font-medium line-through decoration-slate-300 text-xl">${{ number_format($product->price * 1.2, 2) }}</span>
                    </div>

                    <p class="text-slate-600 text-lg leading-relaxed max-w-md">
                        {{ $product->description ?: 'This meticulously crafted piece is currently awaiting a full description from the vendor.' }}
                    </p>

                    <!-- Purchase Card -->
                    <div class="bg-white rounded-3xl border border-slate-200 p-8 shadow-xl shadow-slate-200/50">
                        <div class="flex items-center justify-between mb-8">
                            <div class="flex flex-col">
                                <span class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2">Select Quantity</span>
                                <div class="flex items-center bg-slate-50 rounded-2xl p-1 border border-slate-100">
                                    <button wire:click="decreaseQuantity" class="h-10 w-10 flex items-center justify-center rounded-xl hover:bg-white hover:shadow-sm text-slate-600 transition">-</button>
                                    <span class="w-12 text-center font-bold text-slate-900">{{ $quantity }}</span>
                                    <button wire:click="increaseQuantity" class="h-10 w-10 flex items-center justify-center rounded-xl hover:bg-white hover:shadow-sm text-slate-600 transition">+</button>
                                </div>
                            </div>
                            <div class="text-right">
                                <span class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Inventory</span>
                                <p class="text-sm font-bold text-slate-900">{{ $product->stock_quantity }} units ready</p>
                            </div>
                        </div>

                        <div class="flex flex-col gap-3">
                            @auth
                            <button wire:click="addToCart" class="w-full bg-slate-900 text-white font-bold py-5 rounded-2xl shadow-lg shadow-slate-200 hover:bg-indigo-600 transition-all transform active:scale-[0.98]">
                                ADD TO BAG
                            </button>
                            <button wire:click="buyNow" class="w-full bg-white text-slate-900 border-2 border-slate-100 font-bold py-4 rounded-2xl hover:border-slate-300 transition-all">
                                INSTANT CHECKOUT
                            </button>
                            @else
                            <a href="{{ route('login') }}" class="w-full bg-slate-900 text-white text-center font-bold py-5 rounded-2xl">
                                LOG IN TO ORDER
                            </a>
                            @endauth
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Reviews & Vendor Section -->
        <div class="mt-32 grid grid-cols-1 lg:grid-cols-12 gap-16">
            <div class="lg:col-span-8">
                <div class="flex items-center justify-between mb-10">
                    <h2 class="text-3xl font-black text-slate-900">Guest Feedback</h2>
                    <span class="text-slate-400 font-bold uppercase tracking-widest text-xs">{{ $product->reviews->count() }} Reviews</span>
                </div>

                @auth
                @if(auth()->user()->role === 'Customer')
                <div class="mb-12 bg-indigo-50 rounded-3xl p-8 border border-indigo-100">
                    <form wire:submit.prevent="submitReview">
                        <h3 class="text-lg font-bold text-slate-900 mb-4">Leave a rating</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                            <select wire:model="rating" class="rounded-xl border-slate-200 py-3 font-semibold">
                                <option value="5">★★★★★ (5/5)</option>
                                <option value="4">★★★★☆ (4/5)</option>
                                <option value="3">★★★☆☆ (3/5)</option>
                                <option value="2">★★☆☆☆ (2/5)</option>
                                <option value="1">★☆☆☆☆ (1/5)</option>
                            </select>
                        </div>
                        <textarea wire:model="comment" rows="3" class="w-full rounded-2xl border-slate-200 mb-4 p-4" placeholder="How was the product quality?"></textarea>
                        <button type="submit" class="bg-indigo-600 text-white px-8 py-3 rounded-xl font-bold hover:bg-indigo-700 transition">POST REVIEW</button>
                    </form>
                </div>
                @endif
                @endauth

                @if($product->reviews->isEmpty())
                <div class="text-center py-20 bg-slate-50 rounded-[2rem] border border-dashed border-slate-200">
                    <p class="text-slate-400 font-medium">Be the first to share your experience.</p>
                </div>
                @else
                <div class="space-y-8">
                    @foreach($product->reviews as $review)
                    <div class="relative group">
                        <div class="flex items-start gap-4">
                            <div class="h-12 w-12 rounded-full bg-slate-200 flex-shrink-0 flex items-center justify-center font-bold text-slate-500">
                                {{ substr($review->customer->user->name, 0, 1) }}
                            </div>
                            <div class="flex-1 border-b border-slate-100 pb-8">
                                <div class="flex justify-between items-center mb-2">
                                    <h4 class="font-bold text-slate-900">{{ $review->customer->user->name }}</h4>
                                    <div class="flex text-yellow-400 text-xs">
                                        @for($i=0; $i<$review->rating; $i++) ★ @endfor
                                    </div>
                                </div>
                                <p class="text-slate-500 leading-relaxed">{{ $review->comment }}</p>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                @endif
            </div>

            <!-- Side Vendor Info -->
            <div class="lg:col-span-4">
                <div class="bg-slate-900 rounded-[2.5rem] p-10 text-white sticky top-10 shadow-2xl shadow-slate-300">
                    <span class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-6 block">Store Profile</span>
                    <h3 class="text-3xl font-black mb-2">{{ $product->vendor->store_name ?? 'Local Shop' }}</h3>
                    <p class="text-slate-400 text-sm mb-8 italic">Verified Vendor since 2024</p>
                    
                    <div class="space-y-4 mb-10">
                        <div class="flex justify-between text-sm">
                            <span class="text-slate-500">Representative</span>
                            <span class="font-bold">{{ $product->vendor->user->name ?? 'N/A' }}</span>
                        </div>
                        <div class="flex justify-between text-sm">
                            <span class="text-slate-500">Global Status</span>
                            <span class="text-emerald-400 font-bold uppercase tracking-widest text-[10px]">{{ $product->vendor->approval_status ?? 'Active' }}</span>
                        </div>
                    </div>
                    
                    <button class="w-full bg-white/10 hover:bg-white/20 border border-white/20 text-white font-bold py-4 rounded-2xl transition">
                        VISIT STORE
                    </button>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer Related -->
    <div class="bg-white border-t border-slate-100 py-24 mt-20">
        <div class="max-w-7xl mx-auto px-6">
            <h2 class="text-3xl font-black text-slate-900 mb-12">You might also like</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
                @foreach($relatedProducts as $related)
                <a href="{{ route('products.show', $related) }}" class="group">
                    <div class="rounded-3xl overflow-hidden bg-slate-100 mb-4 aspect-square border border-slate-200">
                        <img src="{{ asset('storage/' . $related->image) }}" class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
                    </div>
                    <h4 class="font-bold text-slate-900 group-hover:text-indigo-600 transition">{{ $related->product_name }}</h4>
                    <p class="text-slate-400 font-bold text-sm mt-1">${{ number_format($related->price, 2) }}</p>
                </a>
                @endforeach
            </div>
        </div>
    </div>
</div>