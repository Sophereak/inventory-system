<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>InvenTrack — Inventory Management System</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 text-gray-800">

    {{-- Navbar --}}
    <nav class="bg-white border-b border-gray-100 shadow-sm">
        <div class="max-w-6xl mx-auto px-6 py-4 flex justify-between items-center">
            <div class="flex items-center gap-2">
                <span class="text-2xl">📦</span>
                <span class="font-bold text-xl text-gray-800">InvenTrack</span>
            </div>
            <div class="flex items-center gap-3">
                @auth
                    <a href="{{ route('dashboard') }}"
                       class="bg-blue-600 text-white px-5 py-2 rounded-lg text-sm font-medium hover:bg-blue-700 transition">
                        Go to Dashboard
                    </a>
                @else
                    <a href="{{ route('login') }}"
                       class="text-gray-600 px-4 py-2 rounded-lg text-sm font-medium hover:bg-gray-100 transition">
                        Login
                    </a>
                    <a href="{{ route('register') }}"
                       class="bg-blue-600 text-white px-5 py-2 rounded-lg text-sm font-medium hover:bg-blue-700 transition">
                        Get Started
                    </a>
                @endauth
            </div>
        </div>
    </nav>

    {{-- Hero Section --}}
    <section class="max-w-6xl mx-auto px-6 py-24 text-center">
        <div class="inline-block bg-blue-50 text-blue-600 text-xs font-semibold px-4 py-2 rounded-full mb-6 uppercase tracking-wide">
            Inventory Management System
        </div>
        <h1 class="text-5xl font-extrabold text-gray-900 leading-tight mb-6">
            Take Control of Your <br>
            <span class="text-blue-600">Stock & Inventory</span>
        </h1>
        <p class="text-lg text-gray-500 max-w-xl mx-auto mb-10">
            InvenTrack helps you manage products, track stock movements, and get real-time reports — all in one simple dashboard.
        </p>
        <div class="flex justify-center gap-4">
            <a href="{{ route('register') }}"
               class="bg-blue-600 text-white px-8 py-3 rounded-xl text-sm font-semibold hover:bg-blue-700 transition shadow-md">
                Get Started Free
            </a>
            <a href="{{ route('login') }}"
               class="bg-white text-gray-700 border border-gray-200 px-8 py-3 rounded-xl text-sm font-semibold hover:bg-gray-50 transition shadow-sm">
                Login
            </a>
        </div>
    </section>

    {{-- Features Section --}}
    <section class="bg-white border-t border-gray-100 py-20">
        <div class="max-w-6xl mx-auto px-6">
            <h2 class="text-3xl font-bold text-center text-gray-800 mb-4">Everything You Need</h2>
            <p class="text-center text-gray-400 mb-14">Simple, powerful tools to manage your inventory efficiently.</p>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
                <div class="bg-gray-50 rounded-2xl p-6 text-center hover:shadow-md transition">
                    <div class="text-4xl mb-4">🏷️</div>
                    <h3 class="font-bold text-gray-800 mb-2">Categories</h3>
                    <p class="text-sm text-gray-500">Organize your products into categories for easy management.</p>
                </div>
                <div class="bg-gray-50 rounded-2xl p-6 text-center hover:shadow-md transition">
                    <div class="text-4xl mb-4">📦</div>
                    <h3 class="font-bold text-gray-800 mb-2">Products</h3>
                    <p class="text-sm text-gray-500">Add and manage all your products with SKU, price and stock info.</p>
                </div>
                <div class="bg-gray-50 rounded-2xl p-6 text-center hover:shadow-md transition">
                    <div class="text-4xl mb-4">🔄</div>
                    <h3 class="font-bold text-gray-800 mb-2">Stock Movements</h3>
                    <p class="text-sm text-gray-500">Record stock in and out movements with full history tracking.</p>
                </div>
                <div class="bg-gray-50 rounded-2xl p-6 text-center hover:shadow-md transition">
                    <div class="text-4xl mb-4">📊</div>
                    <h3 class="font-bold text-gray-800 mb-2">Reports</h3>
                    <p class="text-sm text-gray-500">Filter and analyze stock levels and movement history anytime.</p>
                </div>
            </div>
        </div>
    </section>

    {{-- Stats Section --}}
    <section class="max-w-6xl mx-auto px-6 py-20">
        <div class="bg-blue-600 rounded-3xl p-12 grid grid-cols-1 sm:grid-cols-3 gap-8 text-center text-white">
            <div>
                <p class="text-5xl font-extrabold mb-2">📦</p>
                <p class="text-2xl font-bold mb-1">Products</p>
                <p class="text-blue-200 text-sm">Track unlimited products</p>
            </div>
            <div>
                <p class="text-5xl font-extrabold mb-2">🔄</p>
                <p class="text-2xl font-bold mb-1">Movements</p>
                <p class="text-blue-200 text-sm">Full stock in/out history</p>
            </div>
            <div>
                <p class="text-5xl font-extrabold mb-2">📊</p>
                <p class="text-2xl font-bold mb-1">Reports</p>
                <p class="text-blue-200 text-sm">Filter by date and product</p>
            </div>
        </div>
    </section>

    {{-- Footer --}}
    <footer class="border-t border-gray-100 py-8 text-center text-sm text-gray-400">
        <div class="flex justify-center items-center gap-2 mb-2">
            <span class="text-xl">📦</span>
            <span class="font-bold text-gray-600">InvenTrack</span>
        </div>
        <p>Built with Laravel 12 & Tailwind CSS</p>
        <p class="mt-1">
            <a href="https://github.com/Sophereak/inventory-system" target="_blank"
               class="text-blue-500 hover:underline">View on GitHub →</a>
        </p>
    </footer>

</body>
</html>