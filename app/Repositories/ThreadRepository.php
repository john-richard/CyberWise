<?php

namespace App\Repositories;

use App\Models\Thread;
use App\Models\Post;
use Illuminate\Database\Eloquent\Builder;
use Carbon\Carbon;
use DB;

class ThreadRepository
{

    public function getThreads($condition, $limit = 5)
    {
        return Thread::select('*')
            ->where($condition)
            ->orderBy('created_at', 'desc')
            ->limit($limit)
            ->get();
    }

    /**
     * Get threads with dynamic filters and pagination.
     *
     * @param int $perPage
     * @param array $filters
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getThreadsWithFilters(int $perPage = 20, array $filters = [])
    {
        // Start building the query
        $query = DB::table('threads')
            ->join('thread_categories', 'threads.id', '=', 'thread_categories.thread_id')
            ->join('categories', 'thread_categories.category_id', '=', 'categories.id')
            ->join('users', 'threads.user_id', '=', 'users.id')
            ->where('threads.status', true)
            ->where('categories.community_display', true);
    
        // Apply sorting filters
        if (!empty($filters['sortBy'])) {
            switch ($filters['sortBy']) {
                case 'latest':
                    $query->orderBy('threads.created_at', 'desc');
                    break;
    
                case 'popular':
                    $query->orderByRaw('jsonb_array_length(COALESCE(threads.views, \'[]\'::jsonb)) DESC')
                        ->orderBy('threads.created_at', 'desc');
                    break;
    
                case 'solved':
                    $query->where('threads.closed', true);
                    break;
    
                case 'unsolved':
                    $query->where('threads.closed', false);
                    break;
    
                case 'no-replies':
                    $query->orderByRaw('jsonb_array_length(COALESCE(threads.views, \'[]\'::jsonb)) ASC, threads.created_at DESC');
                    break;
    
                default:
                    $query->orderBy('threads.created_at', 'desc'); // Default to latest
                    break;
            }
        }
    
        // Add select fields
        $query->select(
            'threads.id as thread_id',
            'threads.title',
            'threads.content',
            'threads.created_at',
            'threads.updated_at',
            'threads.views as views_data',
            'users.id as user_id',
            'users.username',
            'users.avatar',
            'categories.id as category_id',
            'categories.name as category_name'
        );
    
        // Paginate results
        $threads = $query->paginate($perPage);

        // Add human-readable relative time to each thread
        foreach ($threads as $thread) {
            $thread->time_ago = Carbon::parse($thread->created_at)->diffForHumans();
            $thread->time_ago = str_replace("from now", "ago", $thread->time_ago);

            // Decode views data if it's a JSON string
            $views = json_decode($thread->views_data, true);
            $thread->views = is_array($views) ? count($views) : 0;

            // set thread name link
            $thread->thread_name = strtolower(str_replace(' ', '-', $thread->title));

            // set thread replies
            $count = Post::where('thread_id',  $thread->thread_id)
                ->whereNull('deleted_at')
                ->count();
            
            $thread->replies = $count;
        }
        \Log::info("TH >> " . print_r($threads, 1));
        
        return $threads;
    }

        /**
     * Fetch thread details by ID.
     *
     * @param int $threadId
     * @return Thread|null
     */
    public function getThreadById(int $threadId)
    {
        $thread = Thread::with([
                'categories' => function ($query) {
                    $query->select('categories.id', 'categories.name')
                          ->where('categories.status', true);
                },
                'user:id,username,avatar',
                'posts' => function ($query) {
                    $query->select('id', 'thread_id', 'user_id', 'content', 'created_at')
                          ->with('user:id,username,avatar')
                          ->whereNull('deleted_at')
                          ->orderBy('created_at', 'desc');
                }
            ])
            ->where('threads.id', $threadId)
            ->where('threads.status', true)
            ->first(['id', 'title', 'content', 'user_id', 'created_at', 'updated_at','views']);
    
        if ($thread) {
            // Flatten categories to return a single category
            $categories = $thread->categories->first();

            // clear categories
            unset($thread->categories);

            // Assign the category as an object with "id" and "name"
            $thread->categories = (object) [
                "id" => $categories->id,
                "name" => $categories->name
            ];

            $posts = $thread->posts;

            // clear posts
            unset($thread->posts);

            // Flatten posts to include user details
            $thread->posts = $posts->map(function ($post) {
                return [
                    'id' => $post->id,
                    'thread_id' => $post->thread_id,
                    'user_id' => $post->user_id,
                    'content' => $post->content,
                    'created_at' => $post->created_at,
                    'time_ago' => str_replace('from now', 'ago', $post->created_at->diffForHumans()),
                    'username' => $post->user->username,
                    'avatar' => $post->user->avatar,
                ];
            });
        }
    
        return $thread;
    }

}
