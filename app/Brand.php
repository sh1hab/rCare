<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    // protected $casts = [
    //    'categories' => 'json',
    // ];


    // public function category()
    // {
    //     return $this->hasMany(Category::class);
    // }

    public function parts()
    {        
        return $this->hasOne(Parts::class);
    }
}
