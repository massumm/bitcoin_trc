<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetailsModel extends Model
{
    use HasFactory;

    protected $table = 'tbl_order_details';

    protected $fillable = ['p_id', 'm_id', 'm_title', 'm_types', 'm_image', 'm_discount', 'm_price', 'quantity', 'tottal_price', 'm_days', 'm_daily_dose', 'm_piese_per_dose', 'm_instruction','m_times', 'm_notes', 'created_by'];
}
