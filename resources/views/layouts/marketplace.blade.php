<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? 'Marketplace' }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>

<body class="min-h-screen bg-slate-50 text-slate-900 antialiased selection:bg-indigo-100 selection:text-indigo-700">

    <div class="min-h-screen bg-[radial-gradient(circle_at_top_left,_rgba(79,70,229,0.08),_transparent_35%),radial-gradient(circle_at_top_right,_rgba(99,102,241,0.06),_transparent_30%)]">

        <x-app-navbar />

        <main class="relative">
            {{ $slot }}
        </main>

        <footer class="border-t border-slate-200/70 bg-white/70 backdrop-blur-xl">
            <div class="mx-auto max-w-7xl px-6 py-6 flex flex-col sm:flex-row items-center justify-between gap-3 text-xs font-semibold text-slate-500">
                <p>
                    © {{ date('Y') }} Marketplace. Built with Laravel, Livewire, Tailwind CSS, and Orchid.
                </p>

                <p class="uppercase tracking-widest text-indigo-500">
                    Multi-vendor commerce system
                </p>
            </div>
        </footer>

    </div>

    @livewireScripts
</body>
</html>