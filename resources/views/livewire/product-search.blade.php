<div class="p-6 bg-white shadow rounded-lg max-w-4xl mx-auto">
    <div class="mb-6">
        <input
                type="text"
                wire:model.live.debounce.500ms="search"
                class="form-input border p-2 w-full"
                placeholder="Search by name..."
        />

    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
        <div>
            <h3 class="text-lg font-semibold mb-2">Categorias:</h3>
            <div class="space-y-2">
                @foreach($categories as $category)
                    <label wire:key="{{ $category->id }}" class="flex items-center space-x-2">
                        <input
                                type="checkbox"
                                wire:model.live="selectedCategories"
                                value="{{ $category->id }}"
                                class="form-checkbox text-blue-600"
                        >
                        <span>{{ $category->name }}</span>
                    </label>
                @endforeach
            </div>
        </div>

        <div>
            <h3 class="text-lg font-semibold mb-2">Marcas:</h3>
            <div class="space-y-2">
                @foreach($brands as $brand)
                    <label wire:key="{{ $brand->id }}" class="flex items-center space-x-2">
                        <input
                                type="checkbox"
                                wire:model.live="selectedBrands"
                                value="{{ $brand->id }}"
                                class="form-checkbox text-blue-600"
                        >
                        <span>{{ $brand->name }}</span>
                    </label>
                @endforeach
            </div>
        </div>
    </div>

    <div class="mb-6">
        <button
                wire:click="clearFilters"
                class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600 transition"
        >
            Limpar Filtros
        </button>
    </div>

    <ul class="space-y-2">
        @forelse($products as $product)
            <li wire:key="{{ $product->id }}"class="p-4 border rounded shadow-sm flex justify-between items-center">
                <div>
                    <p class="font-semibold">{{ $product->name }}</p>
                    <p class="text-sm text-gray-600">
                        {{ $product->category->name }} · {{ $product->brand->name }}
                    </p>
                </div>
            </li>
        @empty
            <li class="text-gray-500">Nenhum produto encontrado.</li>
        @endforelse
    </ul>


    <div class="mt-4">
        {{ $products->links() }}
    </div>

</div>
