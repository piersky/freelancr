<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    use HasFactory;

    protected $fillable =  [
        'description',
        'belongs_to_id',
        'deadline',
        'is_done',
        'customer_id',
        'is_active',
        'created_by',
        'created_at',
        'updated_by',
        'updated_at'
    ];
}
