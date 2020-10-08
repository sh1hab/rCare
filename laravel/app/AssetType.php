<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AssetType extends Model
{
    public function head()
    {
    	return $this->hasMany(AssetHead::class);
    }
}
