<div>
    @if($open)
        <div class="fixed inset-0 bg-black/40 z-40 flex items-center justify-center">
            <div class="bg-white rounded-lg shadow-lg w-full max-w-xl p-6 z-50">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-semibold">{{ $isEdit ? 'Edit Supplier' : 'Tambah Supplier' }}</h3>
                    <button wire:click.prevent="$set('open', false)" class="text-gray-500">✕</button>
                </div>

                <form wire:submit.prevent="save" class="space-y-3">
                    <div>
                        <label class="block text-sm font-medium">Nama</label>
                        <input wire:model.defer="name" class="mt-1 block w-full border rounded px-2 py-1" />
                        @error('name') <div class="text-red-600 text-sm">{{ $message }}</div> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium">Alamat</label>
                        <textarea wire:model.defer="address" class="mt-1 block w-full border rounded px-2 py-1"></textarea>
                        @error('address') <div class="text-red-600 text-sm">{{ $message }}</div> @enderror
                    </div>

                    <div class="grid grid-cols-2 gap-3">
                        <div>
                            <label class="block text-sm font-medium">Telepon</label>
                            <input wire:model.defer="phone" class="mt-1 block w-full border rounded px-2 py-1" />
                        </div>
                        <div>
                            <label class="block text-sm font-medium">Email</label>
                            <input wire:model.defer="email" class="mt-1 block w-full border rounded px-2 py-1" />
                        </div>
                    </div>

                    <div class="flex items-center space-x-2">
                        <button type="submit" class="bg-green-600 text-white px-3 py-1 rounded">Simpan</button>
                        <button type="button" wire:click.prevent="$set('open', false)" class="text-sm text-gray-600">Batal</button>
                    </div>
                </form>
            </div>
        </div>
    @endif
</div>
