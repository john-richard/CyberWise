<?php

namespace App\Repositories;

use App\Models\Post;

class PostRepository
{
    public function getPostById(int $postId)
    {

        $posts = Post::select([
            'posts.id',
            'posts.thread_id', 
            'posts.content', 
            'posts.user_id', 
            'posts.created_at', 
            'posts.updated_at',
            'users.username', 
            'users.avatar'

        ])
        ->join('users', 'posts.user_id', '=', 'users.id')
        ->where('posts.id', $postId)
        ->whereNull('posts.deleted_at')
        ->first();
    
        if ($posts) {
            // set time_ago
            $posts->time_ago = str_replace('from now', 'ago', $posts->created_at->diffForHumans());
        }
    
        return $posts;
    }
}
