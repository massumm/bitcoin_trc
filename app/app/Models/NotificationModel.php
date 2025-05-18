<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class NotificationModel extends Model
{
    use HasFactory;
    protected $table = 'tbl_notification';


    protected $fillable = [
                'uid' ,
                'date',
                'title' ,
                'description' ,
    ];

    public function user()
    {
        return $this->belongsTo(UserModel::class, 'uid');
    }
}
