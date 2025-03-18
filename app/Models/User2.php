<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User2 extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'users';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'number',
        'password',
        'balance',
        'refer_earn',
        'refer_code',
        'refer_by',
        'withdraw_pass',
        'miningstatus',
        'status',
        'ref_earn',
        'min_earn',
        'get_off',
        'today_task',
        'withdraw_add',
        'withdraw_meth',
        'ref_dep_com'
    ];

   
}
