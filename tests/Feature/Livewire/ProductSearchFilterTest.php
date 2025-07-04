<?php

namespace Tests\Feature\Livewire;

use App\Livewire\ProductSearch;
use App\Models\Product;
use Livewire\Livewire;
use Tests\TestCase;

class ProductSearchFilterTest extends TestCase
{
    public function test_can_filter_by_name_category_brand()
    {
        foreach (range(0, 5) as $item) {
            $product = Product::with(['brand', 'category'])->inRandomOrder()->first();
            dump($product->name);
            Livewire::test(ProductSearch::class)
                ->assertSeeLivewire(ProductSearch::class)
                ->assertOk()
                ->set([
                    'search' => $product->name,
                    'selectedCategories' => [$product->category->id],
                    'selectedBrands' => [$product->brand->id],
                ])
                ->assertSet('search', $product->name);
        }
    }

}
