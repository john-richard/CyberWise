<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Thread extends Model
{

    protected $casts = [
        'views' => 'array', 
    ];

    protected $fillable = [
        'id',
        'title',
        'user_id',
        'status',
        'content',
        'closed'
    ];

    /**
     * Relationship with categories.
     */
    public function categories()
    {
        return $this->belongsToMany(Category::class, 'thread_categories', 'thread_id', 'category_id');
    }

    /**
     * Relationship with user.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function featuredThreads()
    {
        return $this->hasMany(FeaturedThread::class);
    }

    public function posts()
    {
        return $this->hasMany(Post::class);
    }
}
