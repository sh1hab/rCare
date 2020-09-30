<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    public function purchase()
    {        
        return $this->hasOne(Purchase::class);
    }
}
