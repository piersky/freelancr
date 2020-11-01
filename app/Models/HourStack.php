<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HourStack extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'qty',
        'price',
        'customer_id',
        'is_active',
        'created_by',
        'created_at',
        'updated_by',
        'updated_at'
    ];
}
