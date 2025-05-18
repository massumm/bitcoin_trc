<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AddMedicine extends Model
{
    use HasFactory;

    protected $table = 'add_medicine';

    protected $fillable = [
                'title' ,
                'image' ,
                'status' ,
                'category' ,
                'brand' ,
                'description' ,
                'created_by'
    ];
}
