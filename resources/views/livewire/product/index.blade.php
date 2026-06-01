<div>
    {{-- Care about people's approval and you will be their prisoner. --}}
<div>
    <div class="flex items-center justify-between mb-4">
        <div>
            <input wire:model.debounce.300ms="search" type="text" placeholder="Cari produk..." class="border rounded px-3 py-2" />
        </div>
        <div>
            @if(auth()->check() && auth()->user()->isAdmin())
                <button onclick="window.location.href='{{ route('products.form') }}'" class="bg-blue-600 text-white px-3 py-2 rounded">Buat Produk</button>
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
                        <button wire:click="$emit('editProduct', {{ $product->id }})" class="px-2 py-1 bg-yellow-400 rounded text-sm">Edit</button>
                        <button wire:click.prevent="delete({{ $product->id }})" class="px-2 py-1 bg-red-500 rounded text-sm text-white">Hapus</button>
                    </div>
                @endif
            </div>
        @endforeach
    </div>

    <div class="mt-4">{{ $products->links() }}</div>
</div>
