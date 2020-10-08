<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AssetHead extends Model
{
    public function type()
    {
        return $this->belongsTo(AssetType::class, 'asset_type_id', 'id');
    }
}
