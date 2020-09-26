<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Warranty extends Model
{
    public function parts()
    {        
        return $this->hasOne(Parts::class);
    }
}
