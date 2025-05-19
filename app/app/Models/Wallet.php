<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Wallet extends Model
{
    protected $fillable = [
        'user_id',
        'user_name',
        'wallet_name',
        'currency_protocol',
        'wallet_address',
        'names',
        'date'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
} 