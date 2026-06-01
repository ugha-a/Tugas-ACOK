<div class="p-4">
    <div class="mb-4">
        <livewire:supplier.form />
    </div>
    <div class="flex items-center justify-between mb-4">
        <div class="flex items-center space-x-2">
            <input wire:model.debounce.300ms="search" type="text" placeholder="Cari supplier..." class="border rounded px-2 py-1" />
        </div>
            @if(auth()->check() && auth()->user()->isAdmin())
            <button wire:click.prevent="openForm" class="btn-primary inline-flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/></svg>
                Tambah Supplier
            </button>
        @endif
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        @foreach($suppliers as $supplier)
            <div class="border p-3 rounded">
                <div class="font-semibold">{{ $supplier->name }}</div>
                <div class="text-sm text-gray-600">{{ $supplier->phone }} • {{ $supplier->email }}</div>
                <div class="mt-2 text-sm">{{ $supplier->address }}</div>
                <div class="mt-3 flex space-x-2">
                    @if(auth()->check() && auth()->user()->isAdmin())
                        <button wire:click.prevent="openForm({{ $supplier->id }})" class="px-2 py-1 bg-yellow-500 text-white rounded inline-flex items-center gap-1">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M15.232 5.232l3.536 3.536M9 11l6-6 3 3-6 6H9v-3z"/></svg>
                            Edit
                        </button>
                        <button wire:click.prevent="delete({{ $supplier->id }})" class="inline-flex items-center justify-center w-8 h-8 rounded bg-red-500 text-white" title="Hapus" aria-label="Hapus">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M6 7h12M9 7v10a2 2 0 0 0 2 2h2a2 2 0 0 0 2-2V7"/><path stroke-linecap="round" stroke-linejoin="round" d="M10 11v6M14 11v6M4 7h16"/></svg>
                        </button>
                    @endif
                </div>
            </div>
        @endforeach
    </div>

    <div class="mt-4">
        {{ $suppliers->links() }}
    </div>
</div>
