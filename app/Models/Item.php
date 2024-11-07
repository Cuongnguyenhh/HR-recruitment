<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Item extends BaseModel
{
    use HasFactory;

    protected $table = 'items';     
    protected $fillable = [
        'price',
        'quantity',
    ];
}