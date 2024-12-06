<?php

namespace App\Repositories;

use App\Models\FeaturedPost;

class FeaturedPostRepository
{
    public function getFeaturedPosts($condition, $limit = 5)
    {
        // Fetch the featured posts with the required conditions and limit the selected fields for featured_posts, top_posts, and thread
        return FeaturedPost::with(['thread' => function($query) {
                $query->select('id', 'title'); // Select only the needed columns from threads
            }, 'topPost' => function($query) {
                $query->select('id', 'title', 'link', 'description','created_at','updated_at'); // Select only the needed columns from top_posts
            }])
            ->whereHas('topPost', function ($query) {
                $query->where('status', true)
                      ->whereNull('deleted_at');
            })
            ->where($condition)
            ->orderBy('created_at', 'desc')
            ->limit($limit)
            ->get(['id', 'top_post_id', 'thread_id']); // Select only the columns needed from featured_posts
    }
}
