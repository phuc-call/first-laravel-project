<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    protected $table = 'product';
    use SoftDeletes;

    // Các cột có thể được gán giá trị
    protected $fillable = [
        'name',
        'description',
        'price_root',
        'price_sale',
        'thumbnail',
        'slug',
    ];
}
