<?php

namespace App\Repositories;

use App\Models\Thread;
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
     * @param int $excludedCategoryId
     * @param int $perPage
     * @param array $filters
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getThreadsWithFilters(int $excludedCategoryId, int $perPage = 20, array $filters = [])
    {
        // Start building the query
        $query = DB::table('threads')
            ->join('thread_categories', 'threads.id', '=', 'thread_categories.thread_id')
            ->join('categories', 'thread_categories.category_id', '=', 'categories.id')
            ->join('users', 'threads.user_id', '=', 'users.id')
            ->where('threads.status', true)
            ->where('categories.id', '!=', $excludedCategoryId);

        // Apply sorting filters
        if (!empty($filters['sortBy'])) {
            switch ($filters['sortBy']) {
                case 'latest':
                    $query->orderBy('threads.created_at', 'desc');
                    break;

                case 'closed':
                    $query->where('threads.closed', true);
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
            'users.id as user_id',
            'users.username',
            'users.avatar',
            'categories.id as category_id',
            'categories.name as category_name'
        );

        // Paginate the results
        $threads = $query->paginate($perPage);

        // Add human-readable relative time to each thread
        foreach ($threads as $thread) {
            $thread->time_ago = Carbon::parse($thread->created_at)->diffForHumans();
        }

        return $threads;
    }

}
