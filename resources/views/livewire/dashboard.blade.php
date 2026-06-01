<div>
    {{-- Knowing others is intelligence; knowing yourself is true wisdom. --}}
<div>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        <div class="bg-white p-6 rounded-lg shadow flex flex-col">
            <div class="text-sm text-gray-500">Total Jenis Produk</div>
            <div class="text-3xl font-bold mt-2">{{ \Schema::hasTable('products') ? \App\Models\Product::count() : 0 }}</div>
            <div class="mt-3 text-sm text-gray-500">Produk terdaftar di sistem</div>
        </div>
        <div class="bg-gradient-to-r from-green-400 to-green-600 text-white p-6 rounded-lg shadow">
            <div class="text-sm">Total Nilai Stok</div>
            <div class="text-3xl font-bold mt-2">Rp {{ \Schema::hasTable('products') ? number_format(\App\Models\Product::sum(\DB::raw('stock * price')), 0, ',', '.') : '0' }}</div>
            <div class="mt-3 text-sm opacity-90">Perkiraan nilai persediaan saat ini</div>
        </div>
        <div class="bg-white p-6 rounded-lg shadow">
            <div class="text-sm text-gray-500">Transaksi Terbaru</div>
            <div class="mt-3 text-sm">
                @if(\Schema::hasTable('transactions'))
                    @foreach(\App\Models\Transaction::latest()->limit(5)->get() as $t)
                        <div class="py-2 border-b">{{ $t->reference_number }} <span class="text-gray-500 text-xs">— {{ $t->type }} • {{ $t->transaction_date }}</span></div>
                    @endforeach
                @else
                    <div class="text-sm text-gray-500">Belum ada data transaksi</div>
                @endif
            </div>
        </div>
    </div>

    <div class="mt-6 grid grid-cols-1 md:grid-cols-2 gap-4">
        <div class="bg-white p-6 rounded-lg shadow">
            <h4 class="font-medium mb-3">Alert Stok Kritis</h4>
            <ul class="space-y-2 text-sm text-gray-700">
                @if(\Schema::hasTable('products'))
                    @foreach(\App\Models\Product::whereColumn('stock', '<=', 'min_stock')->with('supplier','category')->get() as $p)
                        <li class="flex justify-between items-center">
                            <div>
                                <div class="font-semibold">{{ $p->code }} — {{ $p->name }}</div>
                                <div class="text-xs text-gray-500">{{ $p->category?->name }} • {{ $p->supplier?->name }}</div>
                            </div>
                            <div class="text-red-600 font-bold">{{ $p->stock }}</div>
                        </li>
                    @endforeach
                @else
                    <li class="text-sm text-gray-500">Tidak ada produk</li>
                @endif
            </ul>
        </div>
        <div class="bg-white p-6 rounded-lg shadow">
            <h4 class="font-medium mb-3">Grafik Persediaan (Preview)</h4>
            <div class="h-64 bg-gradient-to-b from-gray-50 to-gray-100 rounded flex items-center justify-center text-gray-400">[Chart Placeholder]</div>
        </div>
    </div>
</div>
