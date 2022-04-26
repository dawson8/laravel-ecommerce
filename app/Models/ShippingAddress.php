<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShippingAddress extends Model
{
    use HasFactory;

    protected $fillable = [
        'address',
        'city',
        'postcode'
    ];

    public function user()
    {
        return $this->belogsTo(User::class);
    }
}
