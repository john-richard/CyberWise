<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FeaturedThread extends Model
{

    protected $fillable = [
        'thread_id',
        'title',
        'content',
        'status',
        'link',
        'updated_at',
    ];
}
