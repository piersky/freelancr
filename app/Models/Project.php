<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'customer_id',
        'deadline_date',
        'is_active',
        'created_by',
        'created_at',
        'updated_by',
        'updated_at'
    ];
}
