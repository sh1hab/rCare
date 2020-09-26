<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Parts extends Model
{
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class, 'compatible_brand_id', 'id');
    }

    public function warranty()
    {
        return $this->belongsTo(Warranty::class, 'warranty_id', 'id');
    }
}
