<?php

namespace App\Http\Livewire;

use App\Models\Product;
use Livewire\Component;

class ProductBrowser extends Component
{
    public $category;

    public function render()
    {
        $search = Product::search('', function ($meilisearch, string $query, array $options) {
            $options['facetsDistribution'] = ['size', 'colour'];

            return $meilisearch->search($query, $options);
        })->raw();

        $products = $this->category->products->find(collect($search['hits'])->pluck('id'));

        return view('livewire.product-browser', [
            'products' => $products,
            'filters' => $search['facetsDistribution']
        ]);
    }
}
