<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PurchaseDetails extends Model
{
    public function purchase()
    {
        return $this->belongsTo(Purchase::class, 'purchase_id', 'id');
    }

    public function user()
    {        
        return $this->belongsTo(User::class, 'create_by', 'id');
    }

    public function parts()
    {
        return $this->belongsTo(Parts::class, 'parts_id', 'id');
    }
}
