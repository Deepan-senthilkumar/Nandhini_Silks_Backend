<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'name', 
        'slug', 
        'image', 
        'description', 
        'meta_title', 
        'meta_description', 
        'status', 
        'display_order'
    ];

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
