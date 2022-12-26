<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $fillable = ['order', 'name', 'image', 'imageable_id', 'imageable_type', 'description'];

    public function imageable()
    {
        return $this->morphTo();
    }
}
