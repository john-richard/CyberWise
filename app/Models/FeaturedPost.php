<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FeaturedPost extends Model
{
    use HasFactory;

    protected $fillable = [
        'top_post_id',
        'thread_id',
    ];

    // Relationships
    public function topPost()
    {
        return $this->belongsTo(TopPost::class, 'top_post_id');
    }

    public function thread()
    {
        return $this->belongsTo(Thread::class, 'thread_id');
    }
}
