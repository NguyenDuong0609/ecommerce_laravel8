<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'slug',
        'title',
        'brand_id',
        'category_id',
        'product_type_id',
        'images',
        'price',
        'status',
        'short_description',
        'description',
        'specification',
        'quality',
        'discount'
    ];

    public function category() {
        return $this->belongsTo('App\Models\Category', 'category_id');
    }
}
