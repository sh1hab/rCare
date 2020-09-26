<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BankAccount extends Model
{
    public function bank()
    {
        return $this->belongsTo(Bank::class, 'bank_id', 'id');
    }
}
