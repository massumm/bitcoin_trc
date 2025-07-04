<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;



class CoinNotificationModel extends Model
{
    use HasFactory;
    protected $table = 'coin_notification';


    protected $fillable = [
                'uid' ,
                'date',
                'message' ,
                'read',
    ];

    public function user()
    {
        return $this->belongsTo(User2::class, 'uid');
    }
}
