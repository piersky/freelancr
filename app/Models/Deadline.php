<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Deadline extends Model
{
    use HasFactory;

    protected $fillable = [
        'deadline_category_id',
        'name',
        'description',
        'deadline_at',
        'customer_id',
        'created_by',
        'created_at',
        'updated_by',
        'updated_at'
    ];
}
