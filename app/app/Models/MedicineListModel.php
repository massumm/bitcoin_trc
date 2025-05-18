<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MedicineListModel extends Model
{
    use HasFactory;

    protected $table = 'tbl_product';

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
