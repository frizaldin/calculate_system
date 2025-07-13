<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wishlist extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'photo',
        'name',
        'price',
        'qty',
        'total_price',
        'link_ecommerce',
        'status'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
