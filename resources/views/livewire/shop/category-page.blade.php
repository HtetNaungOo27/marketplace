<div class="min-min-h-screen bg-[#f8fafc] py-12">
    <div class="max-w-7xl mx-auto px-6">
        
        <!-- Header & Search Header -->
        <div class="flex flex-col md:flex-row md:items-end justify-between gap-6 mb-12">
            <div>
                <nav class="flex mb-4">
                    <a href="/" class="text-xs font-bold tracking-widest text-indigo-600 uppercase hover:text-indigo-700 transition">Marketplace</a>
                    <span class="mx-2 text-slate-300">/</span>
                    <span class="text-xs font-bold tracking-widest text-slate-400 uppercase">Categories</span>
                </nav>
                <h1 class="text-4xl font-black text-slate-900 tracking-tight">Browse Collections</h1>
                <p class="text-slate-500 mt-2 font-medium text-lg">Find exactly what you're looking for by department.</p>
            </div>

            <div class="relative w-full md:w-72">
                <input type="text" 
                       placeholder="Filter categories..." 
                       class="w-full pl-4 pr-10 py-3 rounded-2xl border-slate-200 bg-white text-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 shadow-sm">
                <svg class="absolute right-3 top-3.5 h-4 w-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
            </div>
        </div>

        <!-- Category Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
            @foreach($categories as $category)
                <a href="/?category={{ $category->id }}"
                   class="group relative flex flex-col justify-between overflow-hidden rounded-[2.5rem] bg-white border border-slate-200 p-8 shadow-sm transition-all duration-300 hover:shadow-2xl hover:shadow-indigo-500/10 hover:-translate-y-2">
                    
                    <!-- Decorative Background Element -->
                    <div class="absolute -right-4 -top-4 h-24 w-24 rounded-full bg-indigo-50 transition-transform duration-500 group-hover:scale-[2.5]"></div>

                    <div class="relative">
                        <!-- Icon Placeholder (Dynamic or Static) -->
                        <div class="mb-6 inline-flex h-14 w-14 items-center justify-center rounded-2xl bg-slate-900 text-white shadow-lg shadow-slate-200 transition-transform group-hover:rotate-6">
                            <svg class="h-7 w-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                            </svg>
                        </div>

                        <h2 class="text-2xl font-black text-slate-900 leading-tight">
                            {{ $category->category_name }}
                        </h2>
                        
                        <p class="mt-2 text-sm font-bold text-indigo-600 uppercase tracking-widest opacity-0 transition-opacity group-hover:opacity-100">
                            Explore Now &rarr;
                        </p>
                    </div>

                    <div class="relative mt-12 flex items-center justify-between border-t border-slate-100 pt-6">
                        <span class="text-xs font-black text-slate-400 uppercase tracking-widest">
                            Inventory
                        </span>
                        <span class="rounded-full bg-slate-100 px-3 py-1 text-xs font-bold text-slate-700">
                            {{ number_format($category->products_count) }} Items
                        </span>
                    </div>
                </a>
            @endforeach
        </div>

        <!-- Help Section -->
        <div class="mt-20 rounded-[3rem] bg-slate-900 p-12 text-center text-white overflow-hidden relative">
            <div class="absolute inset-0 opacity-10">
                <svg class="h-full w-full" fill="currentColor" viewBox="0 0 100 100" preserveAspectRatio="none">
                    <circle cx="0" cy="0" r="40" />
                    <circle cx="100" cy="100" r="30" />
                </svg>
            </div>
            <div class="relative z-10">
                <h2 class="text-3xl font-black mb-4">Can't find a specific category?</h2>
                <p class="text-slate-400 max-w-lg mx-auto mb-8 font-medium">Our marketplace is growing every day. Suggest a category or talk to our support team.</p>
                <div class="flex flex-col sm:flex-row justify-center gap-4">
                    <button class="bg-white text-slate-900 px-8 py-4 rounded-2xl font-bold hover:bg-indigo-50 transition">Contact Support</button>
                    <button class="bg-white/10 text-white border border-white/20 px-8 py-4 rounded-2xl font-bold hover:bg-white/20 transition">View All Products</button>
                </div>
            </div>
        </div>
    </div>
</div>