<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeadlineCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'lang_id',
        'created_by',
        'created_at',
        'updated_by',
        'updated_at'
    ];
}
