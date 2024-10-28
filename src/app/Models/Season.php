<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Season extends Model
{
    // Productsテーブルとのリレーション
    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_season', 'season_id', 'product_id');
    }
}
