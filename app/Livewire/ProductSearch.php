<?php

namespace App\Livewire;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;

class ProductSearch extends Component
{
    use WithPagination;

    public string $search = '';
    public array $selectedCategories = [];
    public array $selectedBrands = [];

    protected array $queryString = [
        'search' => ['except' => ''],
        'selectedCategories' => ['except' => ''],
        'selectedBrands' => ['except' => ''],
        'page' => ['except' => 1],
    ];


    public function clearFilters()
    {
        $this->reset(['search', 'selectedCategories', 'selectedBrands']);
    }

    // Reset pagination when filters change
    public function updated()
    {
        $this->resetPage();
    }

    public function render()
    {
        $query = Product::query()->with('category', 'brand')

        ->when(strlen($this->search) > 0, fn($query) => $query->where('name', 'like', '%' . $this->search . '%'))
        ->when(!empty($this->selectedCategories), fn($query) => $query->whereIn('category_id', $this->selectedCategories))
        ->when(!empty($this->selectedBrands), fn($query) => $query->whereIn('brand_id', $this->selectedBrands))
        ->orderBy('name');

        return view('livewire.product-search', [
            'products' => $query->paginate(10),
            'categories' => Category::all(),
            'brands' => Brand::all(),
        ]);
    }
}
