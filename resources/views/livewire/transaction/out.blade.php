<div>
    {{-- Because she competes with no one, no one can compete with her. --}}
<div class="max-w-3xl bg-white p-4 rounded shadow">
    <h3 class="font-semibold mb-2">Transaksi Barang Keluar</h3>
    <form wire:submit.prevent="save">
        <div class="grid grid-cols-2 gap-3">
            <div>
                <label class="block text-sm">Tujuan</label>
                <input wire:model="form.destination" class="w-full border px-2 py-1" />
            </div>
            <div>
                <label class="block text-sm">Tanggal</label>
                <input wire:model="form.transaction_date" type="date" class="w-full border px-2 py-1" />
            </div>
        </div>

        <div class="mt-3">
            <h4 class="font-medium">Detail Produk</h4>
            <div class="space-y-2 mt-2">
                @foreach($form['lines'] as $i => $line)
                    <div class="flex space-x-2 items-center">
                        <select wire:model="form.lines.{{ $i }}.product_id" class="border px-2 py-1 w-2/3">
                            <option value="">-- pilih produk --</option>
                            @foreach(\App\Models\Product::all() as $p)
                                <option value="{{ $p->id }}">{{ $p->code }} — {{ $p->name }} ({{ $p->stock }})</option>
                            @endforeach
                        </select>
                        <input wire:model="form.lines.{{ $i }}.quantity" type="number" class="border px-2 py-1 w-1/6" />
                        <input wire:model="form.lines.{{ $i }}.price_at_transaction" type="number" step="0.01" class="border px-2 py-1 w-1/6" />
                        <button type="button" wire:click.prevent="removeLine({{ $i }})" class="text-red-500">×</button>
                    </div>
                @endforeach
            </div>
            <div class="mt-2">
                <button type="button" wire:click.prevent="addLine" class="px-3 py-1 border rounded">Tambah Baris</button>
            </div>
        </div>

        <div class="mt-4">
            <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded">Simpan Transaksi Keluar</button>
            @error('save') <div class="text-red-600 mt-2">{{ $message }}</div> @enderror
        </div>
    </form>
</div>
