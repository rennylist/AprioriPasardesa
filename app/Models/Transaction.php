<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'code_transaction'
    ];

    public function transactiondetail()
	{
		return $this->hasMany('App\Models\TransactionDetail','transaction_id');
	}
}
