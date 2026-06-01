<div>
    {{-- Care about people's approval and you will be their prisoner. --}}
<div>
    <div class="flex items-center justify-between mb-4">
        <div>
            <input wire:model.debounce.300ms="search" type="text" placeholder="Cari produk..." class="border rounded px-3 py-2" />
        </div>
        <div>
            @if(auth()->check() && auth()->user()->isAdmin())
                <button wire:click.prevent="$dispatch('openProductForm')" class="bg-blue-600 text-white px-3 py-2 rounded">Buat Produk</button>
            @endif
        </div>
    </div>

    <div class="grid grid-cols-3 gap-4">
        @foreach($products as $product)
            <div class="bg-white p-4 rounded shadow">
                <div class="font-semibold">{{ $product->code }} — {{ $product->name }}</div>
                <div class="text-sm text-gray-500">{{ $product->category->name ?? '-' }} • {{ $product->supplier->name ?? '-' }}</div>
                <div class="mt-2 flex items-center justify-between">
                    <div class="text-lg">Rp {{ number_format($product->price,0,',','.') }}</div>
                    <div class="text-sm">Stok: {{ $product->stock }}</div>
                </div>
                @if(auth()->check() && auth()->user()->isAdmin())
                    <div class="mt-3 flex space-x-2">
                        <button wire:click.prevent="openEdit({{ $product->id }})" class="px-2 py-1 bg-yellow-400 rounded text-sm">Edit</button>
                        <button wire:click.prevent="delete({{ $product->id }})" class="inline-flex items-center justify-center w-8 h-8 rounded bg-red-500 text-white" title="Hapus" aria-label="Hapus">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M6 7h12M9 7v10a2 2 0 0 0 2 2h2a2 2 0 0 0 2-2V7"/><path stroke-linecap="round" stroke-linejoin="round" d="M10 11v6M14 11v6M4 7h16"/></svg>
                        </button>
                    </div>
                @endif
            </div>
        @endforeach
    </div>

    <div class="mt-4">{{ $products->links() }}</div>

    <livewire:product.form />
</div>
