<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class productlist extends Model
{
    use HasFactory;

    protected $table = 'products';

    protected $fillable = [

        'product_id',
        'product_code',
        'image',
        'title',
        'description',
        'type',
        'price',
        'discount',
        'stock_status',
        'created_by'
    ];
}
