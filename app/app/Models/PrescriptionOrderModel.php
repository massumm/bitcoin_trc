<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class PrescriptionOrderModel extends Model
{
    use HasFactory;
    protected $table = 'tbl_prescription_order';


    protected $fillable = [
                'uid' ,
                'p_image',
                'pay_methode' ,
                'order_date' ,
                'o_status' ,
                'status' ,
                'subtotal' ,
                'tax' ,
                'total' ,
                'insurance_total' ,
                'ins_code' ,
                'hospital' ,
                'department' ,
                'doctor_name' ,
                'created_by' ,
    ];

    public function user()
    {
        return $this->belongsTo(UserModel::class, 'uid');
    }
}
