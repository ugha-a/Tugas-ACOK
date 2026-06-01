<div>
    {{-- Because she competes with no one, no one can compete with her. --}}
<div class="bg-white p-4 rounded shadow max-w-3xl">
    <h3 class="font-semibold mb-3">Transaksi Barang Masuk</h3>
    <form wire:submit.prevent="save">
        <div class="grid grid-cols-2 gap-3">
            <div>
                <label class="block text-sm">Tanggal</label>
                <input wire:model="form.transaction_date" type="date" class="w-full border px-2 py-1" />
            <div class="max-w-3xl bg-white p-4 rounded shadow">
                <h3 class="font-semibold mb-2">Transaksi Barang Masuk</h3>
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

                    <div class="mt-3">
                        <h4 class="font-medium">Detail Produk</h4>
                        <div class="space-y-2">
                            @foreach($form->lines as $i => $line)
                                <div class="grid grid-cols-4 gap-2 items-end">
                                    <div>
                                        <select wire:model="form.lines.{{ $i }}.product_id" class="w-full border px-2 py-1">
                                            <option value="">-- produk --</option>
                                            @foreach(\App\Models\Product::all() as $p)
                                                <option value="{{ $p->id }}">{{ $p->code }} - {{ $p->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div>
                                        <input type="number" min="1" wire:model="form.lines.{{ $i }}.quantity" class="w-full border px-2 py-1" />
                                    </div>
                                    <div>
                                        <input type="number" step="0.01" wire:model="form.lines.{{ $i }}.price_at_transaction" class="w-full border px-2 py-1" />
                                    </div>
                                    <div>
                                        <button type="button" wire:click="removeLine({{ $i }})" class="px-2 py-1 bg-red-500 text-white rounded">Hapus</button>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <div class="mt-2">
                            <button type="button" wire:click="addLine" class="px-3 py-1 bg-blue-600 text-white rounded">Tambah Baris</button>
                        </div>
                    </div>

                    <div class="mt-4">
                        <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded">Simpan Transaksi</button>
                    </div>
                </form>
            </div>
                    <option value="">-- pilih --</option>
                    @foreach(\App\Models\Supplier::all() as $s)
                        <option value="{{ $s->id }}">{{ $s->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="mt-4">
            <h4 class="font-medium">Detail Produk</h4>
            <div class="space-y-2 mt-2">
                @foreach($form->lines as $i => $line)
                    <div class="flex space-x-2 items-center">
                        <select wire:model="form.lines.{{ $i }}.product_id" class="border px-2 py-1 w-2/3">
                            <option value="">-- pilih produk --</option>
                            @foreach(\App\Models\Product::all() as $p)
                                <option value="{{ $p->id }}">{{ $p->code }} — {{ $p->name }}</option>
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
            <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded">Simpan Transaksi</button>
            @error('save') <div class="text-red-600 mt-2">{{ $message }}</div> @enderror
        </div>
    </form>
</div>
