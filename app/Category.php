<?php

namespace App;

use App\Image;
use App\Product;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['order', 'name', 'description', 'image', 'outstanding', 'product_direct'];

    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
