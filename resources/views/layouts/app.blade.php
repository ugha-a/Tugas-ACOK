<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Gudang - Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    @livewireStyles
    <style id="fallback-css">
        :root{
            --bg:#f3f4f6;
            --white:#fff;
            --border:#e5e7eb;
            --primary:#2563eb;
            --accent:#06b6d4;
            --muted:#6b7280;
            --success:#10b981;
            --danger:#ef4444;
        }
        body{background:var(--bg);font-family: system-ui, -apple-system, 'Segoe UI', Roboto, 'Helvetica Neue', Arial;color:#111827}
        .flex{display:flex}
        .w-64{width:16rem}
        .min-h-screen{min-height:100vh}
        .bg-white{background:var(--white)}
        .border{border:1px solid var(--border)}
        .rounded{border-radius:0.5rem}
        .p-4{padding:1rem}
        .p-6{padding:1.5rem}
        .flex-1{flex:1}
        .grid{display:grid}
        .grid-cols-3{grid-template-columns:repeat(3,1fr)}
        .col-span-2{grid-column:span 2}
        .text-2xl{font-size:1.5rem;font-weight:600}
        .font-semibold{font-weight:600}
        .max-w-7xl{max-width:80rem;margin-left:auto;margin-right:auto}
        .mx-auto{margin-left:auto;margin-right:auto}
        a{color:var(--primary)}
        .btn-primary{background:var(--primary);color:white;padding:.5rem .75rem;border-radius:.375rem}
        .btn-danger{background:var(--danger);color:white;padding:.4rem .6rem;border-radius:.375rem}
        .icon{width:1rem;height:1rem;display:inline-block;vertical-align:middle}
    </style>
</head>
<body class="bg-gray-100 min-h-screen font-sans">
    <div class="min-h-screen flex flex-col">
        <header class="bg-white border-b">
            <div class="max-w-7xl mx-auto px-4 py-3 flex items-center justify-between">
                <div class="flex items-center space-x-4">
                    <div class="flex items-center space-x-3">
                        <div class="p-2 bg-primary rounded-full text-white">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3 7v4a1 1 0 0 0 1 1h3v6h8v-6h3a1 1 0 0 0 1-1V7" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M16 3v4M8 3v4" />
                            </svg>
                        </div>
                        <div class="text-lg font-bold">Gudang</div>
                    </div>
                    @auth
                        <nav class="hidden md:flex space-x-2 text-sm text-gray-700">
                            <a href="{{ route('dashboard') }}" class="px-3 py-2 rounded hover:bg-gray-100">Dashboard</a>
                            <a href="{{ route('products.index') }}" class="px-3 py-2 rounded hover:bg-gray-100">Produk</a>
                            <a href="{{ route('categories.index') }}" class="px-3 py-2 rounded hover:bg-gray-100">Kategori</a>
                            <a href="{{ route('suppliers.index') }}" class="px-3 py-2 rounded hover:bg-gray-100">Supplier</a>
                        </nav>
                    @endauth
                </div>
                <div>
                    @auth
                        <div class="flex items-center space-x-3">
                            <div class="flex items-center space-x-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon text-gray-700" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 1 1-8 0 4 4 0 0 1 8 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 14c-4 0-6 2-6 4v1h12v-1c0-2-2-4-6-4z" />
                                </svg>
                                <div class="text-sm text-gray-700">{{ auth()->user()->name }}</div>
                            </div>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button class="text-sm text-gray-600 hover:underline flex items-center gap-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7" />
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M7 8v8" />
                                    </svg>
                                    Logout
                                </button>
                            </form>
                        </div>
                    @endauth
                </div>
            </div>
        </header>

        <div class="flex flex-1">
            @auth
                <aside class="w-64 bg-white border-r hidden md:block">
                    <div class="p-4 font-bold">Menu</div>
                    <nav class="p-4 space-y-2 text-sm">
                        <a href="{{ route('dashboard') }}" class="block px-3 py-2 rounded hover:bg-gray-100">Dashboard</a>
                        <a href="{{ route('products.index') }}" class="block px-3 py-2 rounded hover:bg-gray-100">Produk</a>
                        <a href="{{ route('categories.index') }}" class="block px-3 py-2 rounded hover:bg-gray-100">Kategori</a>
                        <a href="{{ route('suppliers.index') }}" class="block px-3 py-2 rounded hover:bg-gray-100">Supplier</a>
                        <a href="{{ route('transactions.in') }}" class="block px-3 py-2 rounded hover:bg-gray-100">Transaksi Masuk</a>
                        <a href="{{ route('transactions.out') }}" class="block px-3 py-2 rounded hover:bg-gray-100">Transaksi Keluar</a>
                    </nav>
                </aside>
            @endauth

            <main class="flex-1 p-6">
                @yield('content')
            </main>
        </div>
    </div>
    @livewireScripts
</body>
</html>
