<?php

namespace App\Repositories;

use App\Models\FeaturedThread;
use Carbon\Carbon;
use DB;

class FeaturedThreadRepository
{
    /**
     * Get threads with dynamic filters and pagination.
     *
     * @param int $perPage
     * @param array $filters
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getLearningHubWithFilters(int $perPage = 20, array $filters = [])
    {
        // Start building the query with prepared statements
        $query = DB::table('featured_threads')
            ->join('threads', 'featured_threads.thread_id', '=', 'threads.id')
            ->join('thread_categories', 'thread_categories.thread_id', '=', 'threads.id')
            ->join('categories', 'thread_categories.category_id', '=', 'categories.id')
            ->join('users', 'threads.user_id', '=', 'users.id')
            ->where('threads.status', true)
            ->where('featured_threads.status', true)
            ->where('categories.id', 7); // Learning Hub category
    
        // apply search
        $searchTerm = $filters['search'] ?? '';

        if (!empty($searchTerm)) {
            // Check if tsquery is empty
            $tsQuery = DB::selectOne("SELECT websearch_to_tsquery('english', ?) AS query", [$searchTerm])->query;
        
            if (empty($tsQuery)) {
                // Fallback to ILIKE
                $query->where(function ($q) use ($searchTerm) {
                    $q->where('featured_threads.title', 'ILIKE', "%{$searchTerm}%")
                    ->orWhere('featured_threads.content', 'ILIKE', "%{$searchTerm}%");
                });
            } else {
                $query->whereRaw("featured_threads.search_vector @@ websearch_to_tsquery('english', ?)", [$searchTerm]);
            }
        }

        if (!empty($filters['orderBy'])) {
            $query->orderBy($filters['orderBy'][0],$filters['orderBy'][1]);
        }
    
        // Select required fields
        $query->select(
            'threads.title as thread_title',
            'featured_threads.id as featured_thread_id',
            'featured_threads.title',
            'featured_threads.content',
            'featured_threads.link',
            'featured_threads.created_at',
            'featured_threads.status',
            DB::raw("featured_threads.metadata->>'icon' as icon"),
            DB::raw("TO_CHAR(featured_threads.created_at, 'Mon DD, YYYY') as created_date"),
            'featured_threads.updated_at',
            'users.id as user_id',
            'users.username',
            'users.avatar',
            'categories.id as category_id',
            'categories.name as category_name'
        );
    
        // Paginate the results
        return $query->paginate($perPage);
    }
    
    /**
     * Get threads with dynamic filters and pagination.
     *
     * @param int $perPage
     * @param array $filters
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getTestYourKnowledgeWithFilters(int $perPage = 20, array $filters = [])
    {
        // Start building the query with prepared statements
        $query = DB::table('featured_threads')
            ->join('threads', 'featured_threads.thread_id', '=', 'threads.id')
            ->join('thread_categories', 'thread_categories.thread_id', '=', 'threads.id')
            ->join('categories', 'thread_categories.category_id', '=', 'categories.id')
            ->join('users', 'threads.user_id', '=', 'users.id')
            ->where('threads.status', true)
            ->where('featured_threads.status', true)
            ->where('categories.id', 8); // Test Your Knowledge category
    
        // apply search
        $searchTerm = $filters['search'] ?? '';

        if (!empty($searchTerm)) {
            // Check if tsquery is empty
            $tsQuery = DB::selectOne("SELECT websearch_to_tsquery('english', ?) AS query", [$searchTerm])->query;
        
            if (empty($tsQuery)) {
                // Fallback to ILIKE
                $query->where(function ($q) use ($searchTerm) {
                    $q->where('featured_threads.title', 'ILIKE', "%{$searchTerm}%")
                    ->orWhere('featured_threads.content', 'ILIKE', "%{$searchTerm}%");
                });
            } else {
                $query->whereRaw("featured_threads.search_vector @@ websearch_to_tsquery('english', ?)", [$searchTerm]);
            }
        }


        // Handle sorting
        if (!empty($filters['orderBy'])) {
            if ($filters['orderBy'] === 'random') {
                $query->orderByRaw('RANDOM()'); // Use 'RAND()' for MySQL
            } elseif (is_array($filters['orderBy']) && count($filters['orderBy']) === 2) {
                $query->orderBy($filters['orderBy'][0], $filters['orderBy'][1]);
            }
        }
    
        // Select required fields
        $query->select(
            'threads.title as thread_title',
            'featured_threads.id as featured_thread_id',
            'featured_threads.title',
            'featured_threads.content',
            'featured_threads.link',
            'featured_threads.created_at',
            'featured_threads.status',
            'featured_threads.metadata',
            DB::raw("featured_threads.metadata->>'icon' as icon"),
            DB::raw("TO_CHAR(featured_threads.created_at, 'Mon DD, YYYY') as created_date"),
            'featured_threads.updated_at',
            'users.id as user_id',
            'users.username',
            'users.avatar',
            'categories.id as category_id',
            'categories.name as category_name'
        );
    
        // Paginate the results
        return $query->paginate($perPage);
    }

/**
     * Get threads with dynamic filters and pagination.
     *
     * @param int $perPage
     * @param array $filters
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getSelfAssessmentWithFilters(int $perPage = 20, array $filters = [])
    {
        // Start building the query with prepared statements
        $query = DB::table('featured_threads')
            ->join('threads', 'featured_threads.thread_id', '=', 'threads.id')
            ->join('thread_categories', 'thread_categories.thread_id', '=', 'threads.id')
            ->join('categories', 'thread_categories.category_id', '=', 'categories.id')
            ->join('users', 'threads.user_id', '=', 'users.id')
            ->where('threads.status', true)
            ->where('featured_threads.status', true)
            ->where('categories.id', 9); // Self Assessment category
    
        // apply search
        $searchTerm = $filters['search'] ?? '';

        if (!empty($searchTerm)) {
            // Check if tsquery is empty
            $tsQuery = DB::selectOne("SELECT websearch_to_tsquery('english', ?) AS query", [$searchTerm])->query;
        
            if (empty($tsQuery)) {
                // Fallback to ILIKE
                $query->where(function ($q) use ($searchTerm) {
                    $q->where('featured_threads.title', 'ILIKE', "%{$searchTerm}%")
                    ->orWhere('featured_threads.content', 'ILIKE', "%{$searchTerm}%");
                });
            } else {
                $query->whereRaw("featured_threads.search_vector @@ websearch_to_tsquery('english', ?)", [$searchTerm]);
            }
        }


        // Handle sorting
        if (!empty($filters['orderBy'])) {
            if ($filters['orderBy'] === 'random') {
                $query->orderByRaw('RANDOM()'); // Use 'RAND()' for MySQL
            } elseif (is_array($filters['orderBy']) && count($filters['orderBy']) === 2) {
                $query->orderBy($filters['orderBy'][0], $filters['orderBy'][1]);
            }
        }
    
        // Select required fields
        $query->select(
            'threads.title as thread_title',
            'featured_threads.id as featured_thread_id',
            'featured_threads.title',
            'featured_threads.content',
            'featured_threads.link',
            'featured_threads.created_at',
            'featured_threads.status',
            'featured_threads.metadata',
            DB::raw("featured_threads.metadata->>'icon' as icon"),
            DB::raw("TO_CHAR(featured_threads.created_at, 'Mon DD, YYYY') as created_date"),
            'featured_threads.updated_at',
            'users.id as user_id',
            'users.username',
            'users.avatar',
            'categories.id as category_id',
            'categories.name as category_name'
        );
    
        // Paginate the results
        return $query->paginate($perPage);
    }    

    public function findFeaturedThreadByIds($ids)
    {
        return FeaturedThread::whereIn('id', $ids)->get();
    }


}
