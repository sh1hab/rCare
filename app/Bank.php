<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bank extends Model
{
	
	protected $fillable = [
        'short_name', 'full_name',
    ];

    protected $hidden = ['opening_balance'];

    public function bank_account()
    {
        return $this->hasMany(BankAccount::class);
    }
}
