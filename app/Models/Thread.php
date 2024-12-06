<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Thread extends Model
{

    protected $fillable = [
        'title',
        'user_id',
    ];

    public function featuredThreads()
    {
        return $this->hasMany(FeaturedThread::class);
    }
}
