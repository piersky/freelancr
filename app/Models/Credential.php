<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Credential extends Model
{
    use HasFactory;

    protected $fillable = [
        'credential_category_id',
        'name',
        'host_name',
        'user_name',
        'password',
        'description',
        'customer_id',
        'created_by',
        'created_at',
        'updated_by',
        'updated_at'
    ];
}
