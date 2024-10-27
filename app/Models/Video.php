<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'description',
        'long_description',
        'category_id',
        'course_id',
        'image',
        'video_path',
        'is_free'
    ];

    public function category()
    {
       return $this->belongsTo(Category::class, 'category_id');
    }
}
