<?php

namespace App\Models;

use Cknow\Money\Money;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Staudenmeir\LaravelAdjacencyList\Eloquent\HasRecursiveRelationships;

class Variation extends Model
{
    use HasFactory;
    use HasRecursiveRelationships;

    public function formattedPrice()
    {
        return Money::GBP($this->price);
    }

    public function stocks()
    {
        return $this->hasMany(Stock::class);
    }

    public function Product()
    {
        return $this->belongsTo(Product::class);
    }
}
