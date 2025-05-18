<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BasicSettingModel extends Model
{
    use HasFactory;

    protected $table = 'tbl_basic_setting';

    protected $fillable = [
                'd_title' ,
                'tax' ,
                'currency' ,
                'push_id' ,
                'insurance_status' ,
                'created_by' ,
    ];
}
