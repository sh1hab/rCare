<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bank extends Model
{
    public function bank_account()
    {
        return $this->hasMany(BankAccount::class);
    }
}
