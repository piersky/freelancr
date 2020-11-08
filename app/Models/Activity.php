<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'project_id',
        'start_at',
        'stop_at',
        'used_hours',
        'hourstack_id',
        'assigned_to',
        'is_active',
        'created_by',
        'created_at',
        'updated_by',
        'updated_at'
    ];
}
