<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'content',
        'link',
        'category_id',
        'author_id',
        'is_published',
        'created_by',
        'created_at',
        'updated_by',
        'updated_at'
    ];
}
