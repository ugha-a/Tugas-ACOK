<div>
    <div class="flex items-center justify-between mb-4">
        <div>
            <input wire:model.debounce.300ms="search" type="text" placeholder="Cari nomor referensi..." class="border rounded px-3 py-2" />
        </div>
        <div>
            <a href="{{ route('transactions.in') }}" class="px-3 py-2 rounded bg-gray-200">Transaksi Masuk</a>
            <a href="{{ route('transactions.out') }}" class="px-3 py-2 rounded bg-gray-200 ml-2">Transaksi Keluar</a>
        </div>
    </div>

    <div class="space-y-3">
        @foreach($transactions as $t)
            <div class="bg-white p-4 rounded border">
                <div class="flex items-center justify-between">
                    <div>
                        <div class="font-semibold">{{ strtoupper($t->type) }} — {{ $t->reference_number }}</div>
                        <div class="text-sm text-gray-600">Tanggal: {{ $t->transaction_date->format('Y-m-d') }} • Oleh: {{ $t->user->name ?? '-' }} • Supplier: {{ $t->supplier->name ?? '-' }}</div>
                    </div>
                    <div class="text-right">
                        <div class="text-lg">Items: {{ $t->total_items }}</div>
                    </div>
                </div>

                <div class="mt-3 grid grid-cols-3 gap-2 text-sm">
                    @foreach($t->details as $d)
                        <div class="col-span-1 bg-gray-50 p-2 rounded">
                            <div class="font-medium">{{ $d->product->name ?? 'Produk dihapus' }}</div>
                            <div class="text-xs text-gray-600">Qty: {{ $d->quantity }} • Harga: Rp {{ number_format($d->price_at_transaction,0,',','.') }}</div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endforeach
    </div>

    <div class="mt-4">{{ $transactions->links() }}</div>
</div>
