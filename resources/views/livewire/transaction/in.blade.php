<div>
<div class="bg-white p-4 rounded shadow max-w-3xl">
    <h3 class="font-semibold mb-3">Transaksi Barang Masuk</h3>

    <form wire:submit.prevent="save">
        <div class="grid grid-cols-2 gap-3">
            <div>
                <label class="block text-sm">Supplier</label>
                <select wire:model="form.supplier_id" class="w-full border px-2 py-1">
                    <option value="">-- pilih --</option>
                    @foreach(\App\Models\Supplier::all() as $s)
                        <option value="{{ $s->id }}">{{ $s->name }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="block text-sm">Tanggal</label>
                <input type="date" wire:model="form.transaction_date" class="w-full border px-2 py-1" />
            </div>
        </div>

        <div class="mt-4">
            <h4 class="font-medium">Detail Produk</h4>
            <div class="space-y-2 mt-2">
                @foreach($form['lines'] as $i => $line)
                    <div class="grid grid-cols-4 gap-2 items-end">
                        <div>
                            <select wire:model="form.lines.{{ $i }}.product_id" class="w-full border px-2 py-1">
                                <option value="">-- pilih produk --</option>
                                @foreach(\App\Models\Product::all() as $p)
                                    <option value="{{ $p->id }}">{{ $p->code }} — {{ $p->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm">Qty</label>
                            <input wire:model="form.lines.{{ $i }}.quantity" type="number" min="1" class="border px-2 py-1 w-full" />
                        </div>
                        <div>
                            <label class="block text-sm">Harga</label>
                            <input wire:model="form.lines.{{ $i }}.price_at_transaction" type="number" step="0.01" class="border px-2 py-1 w-full" />
                        </div>
                        <div class="text-right">
                            <button type="button" wire:click.prevent="removeLine({{ $i }})" class="px-2 py-1 bg-red-500 text-white rounded">Hapus</button>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="mt-2">
                <button type="button" wire:click.prevent="addLine" class="px-3 py-1 bg-blue-600 text-white rounded">Tambah Baris</button>
            </div>
        </div>

        <div class="mt-4">
            <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded">Simpan Transaksi</button>
            @error('save') <div class="text-red-600 mt-2">{{ $message }}</div> @enderror
        </div>
    </form>
</div>

<div class="mt-6 max-w-3xl">
    <h4 class="font-semibold mb-2">Riwayat Transaksi Masuk (Terbaru)</h4>
    <div class="space-y-2">
        @foreach(\App\Models\Transaction::where('type','in')->latest()->take(10)->get() as $t)
            <div class="bg-white p-3 rounded border">
                <div class="flex justify-between">
                    <div>{{ $t->reference_number }} — {{ $t->transaction_date->format('Y-m-d') }}</div>
                    <div class="text-sm text-gray-600">Items: {{ $t->total_items }}</div>
                </div>
                <div class="text-xs text-gray-600 mt-1">
                    @foreach($t->details as $d)
                        <div>{{ $d->product->name ?? 'Produk dihapus' }} × {{ $d->quantity }}</div>
                    @endforeach
                </div>
            </div>
        @endforeach
    </div>
</div>
</div>
