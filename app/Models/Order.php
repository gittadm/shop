<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public function getProductNamesAttribute()
    {
       if (empty($this->products)) {
           return '';
       }

       return implode(', ', $this->products->pluck('name')->toArray());
    }

    public function getTotalPriceAttribute()
    {
        $totalPrice = 0;
        foreach ($this->products as $product) {
            $totalPrice += $product->price * $product->pivot->count;
        }
        return $totalPrice;
    }

    public function products()
    {
        return $this->belongsToMany(Product::class)
            ->withPivot('count')
            ->withTimestamps();
    }
}
