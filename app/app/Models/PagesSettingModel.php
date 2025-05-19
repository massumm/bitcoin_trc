<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PagesSettingModel extends Model
{
    use HasFactory;
    protected $table = 'tbl_pages_setting';

    protected $fillable = [
                'privacy' ,
                'about' ,
                'contact' ,
                'terms' ,
                'created_by' ,
    ];
}
