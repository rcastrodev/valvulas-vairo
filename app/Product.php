<?php

namespace App;

use App\Image;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['category_id', 'order', 'name', 'description', 'outstanding', 'data_sheet', 'extra1', 'extra2', 'extra3'];

    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
