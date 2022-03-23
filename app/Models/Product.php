<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $table = 'products';
    protected $fillable = [
        'cate_id',
        'name',
        'small_descriptiom',
        'original_price',
        'selling_price',
        'image',
        'slug',
        'qty',
        'tax',
        'status',
        'trending',
        'meta_title',
        'meta_keywords',
        'meta_description',
    ];

    public function category(){
        return $this->belongsTo(category::class, 'cate_id' , 'id');
    }
}
