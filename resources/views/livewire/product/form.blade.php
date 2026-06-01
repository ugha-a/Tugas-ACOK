<div>
    {{-- Care about people's approval and you will be their prisoner. --}}
<div class="max-w-2xl bg-white p-4 rounded shadow">
    <form wire:submit.prevent="save">
        <div class="grid grid-cols-2 gap-3">
            <div>
                <label class="block text-sm">Code</label>
                <input wire:model.defer="form.code" class="w-full border rounded px-2 py-1" />
                @error('form.code') <div class="text-red-600 text-sm">{{ $message }}</div> @enderror
            <div class="max-w-2xl">
                <form wire:submit.prevent="save" class="bg-white p-4 rounded shadow">
                    <div class="grid grid-cols-2 gap-3">
                        <div>
                            <label class="block text-sm">Category</label>
                            <select wire:model="form.category_id" class="w-full border px-2 py-1">
                                <option value="">-- pilih --</option>
                                @foreach(\App\Models\Category::all() as $c)
                                    <option value="{{ $c->id }}">{{ $c->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm">Supplier</label>
                            <select wire:model="form.supplier_id" class="w-full border px-2 py-1">
                                <option value="">-- pilih --</option>
                                @foreach(\App\Models\Supplier::all() as $s)
                                    <option value="{{ $s->id }}">{{ $s->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="mt-3">
                        <label class="block text-sm">Code</label>
                        <input wire:model="form.code" class="w-full border px-2 py-1" />
                    </div>

                    <div class="mt-3">
                        <label class="block text-sm">Name</label>
                        <input wire:model="form.name" class="w-full border px-2 py-1" />
                    </div>

                    <div class="grid grid-cols-3 gap-3 mt-3">
                        <div>
                            <label class="block text-sm">Price</label>
                            <input wire:model="form.price" type="number" step="0.01" class="w-full border px-2 py-1" />
                        </div>
                        <div>
                            <label class="block text-sm">Stock</label>
                            <input wire:model="form.stock" type="number" class="w-full border px-2 py-1" />
                        </div>
                        <div>
                            <label class="block text-sm">Min Stock</label>
                            <input wire:model="form.min_stock" type="number" class="w-full border px-2 py-1" />
                        </div>
                    </div>

                    <div class="mt-4 flex space-x-2">
                        <button type="submit" class="bg-blue-600 text-white px-3 py-2 rounded">Simpan</button>
                        <button type="button" wire:click="resetForm" class="px-3 py-2 border rounded">Batal</button>
                    </div>
                </form>
            </div>
                @error('form.name') <div class="text-red-600 text-sm">{{ $message }}</div> @enderror
            </div>
        </div>

        <div class="grid grid-cols-3 gap-3 mt-3">
            <div>
                <label class="block text-sm">Category</label>
                <select wire:model.defer="form.category_id" class="w-full border rounded px-2 py-1">
                    <option value="">- pilih -</option>
                    @foreach(\App\Models\Category::all() as $c)
                        <option value="{{ $c->id }}">{{ $c->name }}</option>
                    @endforeach
                </select>
                @error('form.category_id') <div class="text-red-600 text-sm">{{ $message }}</div> @enderror
            </div>
            <div>
                <label class="block text-sm">Supplier</label>
                <select wire:model.defer="form.supplier_id" class="w-full border rounded px-2 py-1">
                    <option value="">- pilih -</option>
                    @foreach(\App\Models\Supplier::all() as $s)
                        <option value="{{ $s->id }}">{{ $s->name }}</option>
                    @endforeach
                </select>
                @error('form.supplier_id') <div class="text-red-600 text-sm">{{ $message }}</div> @enderror
            </div>
            <div>
                <label class="block text-sm">Price</label>
                <input wire:model.defer="form.price" type="number" step="0.01" class="w-full border rounded px-2 py-1" />
                @error('form.price') <div class="text-red-600 text-sm">{{ $message }}</div> @enderror
            </div>
        </div>

        <div class="grid grid-cols-2 gap-3 mt-3">
            <div>
                <label class="block text-sm">Stock</label>
                <input wire:model.defer="form.stock" type="number" class="w-full border rounded px-2 py-1" />
                @error('form.stock') <div class="text-red-600 text-sm">{{ $message }}</div> @enderror
            </div>
            <div>
                <label class="block text-sm">Min Stock</label>
                <input wire:model.defer="form.min_stock" type="number" class="w-full border rounded px-2 py-1" />
                @error('form.min_stock') <div class="text-red-600 text-sm">{{ $message }}</div> @enderror
            </div>
        </div>

        <div class="mt-4">
            <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded">Simpan</button>
        </div>
    </form>
</div>
