<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentListModel extends Model
{
    use HasFactory;
    protected $table = 'tbl_payment_setting';

    protected $fillable = [
        'title',
        'img',
        'attributes',
        'status',
        'subtitle',
        'p_show',
    ];
}

