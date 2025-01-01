<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ThreadCategory extends Model
{
    public $incrementing = false; // Disable auto-incrementing
    public $timestamps = false; // If your table doesn't use timestamps, disable them
    protected $primaryKey = null; // Specify there's no primary key

    protected $fillable = [
        'thread_id',
        'category_id',
    ];
}
