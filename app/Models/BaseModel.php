<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BaseModel extends Model
{
    protected $fillable = ['name', 'description', 'created_time', 'deleted_time', 'is_active', 'is_deleted'];

    public $timestamps = true; // Sử dụng timestamps

    const CREATED_AT = 'created_time';
    const UPDATED_AT = 'updated_time';
}