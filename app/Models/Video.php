<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    use HasFactory;
    protected $fillable = [
        'title', 'description', 'long_description', 
        'category', 'course', 'image', 'url', 'is_free'
    ];
}
