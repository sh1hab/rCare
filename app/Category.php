<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    // public function brands()
    // {
    //    return $this->belongsTo(Brand::class, 'categories', 'id');
    // }

    public function parts()
    {        
        return $this->hasOne(Parts::class);
    }
}
