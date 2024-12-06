<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    
    public function threads()
    {
        return $this->belongsToMany(Thread::class, 'thread_categories', 'category_id', 'thread_id');
    }
}

