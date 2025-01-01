<?php

namespace App\Services;

use App\Models\ThreadCategory;
use App\Models\Thread;
use App\Repositories\ThreadRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class ThreadService
{
    protected $threadRepository;

    public function __construct(ThreadRepository $threadRepository)
    {
        $this->threadRepository = $threadRepository;
    }

    /**
     * Get threads excluding a specific category with dynamic filters.
     *
     * @param int $excludedCategoryId
     * @param int $perPage
     * @param array $filters
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getThreadsWithFilters(int $perPage = 20, array $filters = [])
    {
        return $this->threadRepository->getThreadsWithFilters($perPage, $filters);
    }

    /**
     * Fetch a specific thread and related data.
     *
     * @param int $threadId
     * @return array
     */
    public function showThread(int $threadId, string $threadName)
    {
        try {

            $user = Auth::user(); 

            // Check if user is authenticated
            if (!$user) {
                return response()->json(['error' => 'Unauthorized. Please log in.'], 401);
            }
    

            // Fetch the thread details by ID and thread name
            $thread = $this->threadRepository->getThreadById($threadId);

            if (!$thread) {
                return ['error' => 'Thread not found'];
            }

            // update views
            $userViews = is_array($thread->views) ? $thread->views : [];

            \Log::info("PARAMS >> " . print_r([$thread->id, $user->id, $userViews], 1));

            $this->updateViews($thread->id, $user->id, $userViews);

            // Process additional data if required
            $thread->time_ago = $thread->created_at->diffForHumans();
            $thread->views = is_array($thread->views) ? count($thread->views) : 0;

            \Log::info("thread >>> " .  print_r($thread->views , 1));



            return $thread;
        } catch (\Exception $e) {
            return ['error' => $e->getMessage()];
        }
    }
    
    /**
     * Fetch a dynamic number of featured posts with related data.
     *
     * @param array $data
     * @return \Illuminate\Database\Eloquent\Collection
     * @throws ValidationException
     */
    public function getThreads(array $data)
    {
        // Validate input data
        $validated = $this->validateData('get', $data);
    
        $limit = $validated['limit'] ?? 5; // Default limit if not provided
    
        // Fetch the featured posts with the required conditions
        return $this->threadRepository->getThreads(['status' => true], $limit);
    }
    
    public function createThread(array $data)
    {
        $user = Auth::user(); 

        // Check if user is authenticated
        if (!$user) {
            return response()->json(['error' => 'Unauthorized. Please log in.'], 401);
        }

        $data['user_id'] = $user->id;

        // sanitize thread title
        $data['title'] = $this->sanitizeTitle($data['title']);

        // Validate input data
        $this->validateData('create', $data);

        // Create a thread
        $thread = Thread::create($data);

        ThreadCategory::create([
            'thread_id' => $thread->id,
            'category_id' => $data['category_id'],
        ]);

        return [
            'data' => $thread,
            'redirect_url' => '/community#posts',
        ];

    }

    public function updateThread($id, array $data)
    {
        // Validate the incoming data
        $this->validateData('update', $data);

        // Find the thread by ID and update it
        $thread = Thread::findOrFail($id);
        $thread->update([
            'title' => $data['title'],
            'link' => $data['link'],
            'description' => $data['description'] ?? null,
        ]);

        return $thread;
    }

    public function updateViews($threadId, $userId, $userViews)
    {
        // Find the thread by ID and update it
        $thread = Thread::findOrFail($threadId);
    
        // If user already in views list or owns the thread, return
        if ($thread->user_id === $userId || in_array($userId, $userViews)) {
            return $userViews;
        }
    
        // Add userId to the userViews array
        array_push($userViews, $userId);
    
        // Update the thread with the modified array
        $thread->views = $userViews;
        $success = $thread->save(); // Use save() for JSONB instead of update()
    
        if (!$success) {
            Log::error('Failed to update views');
        }
    
        return $userViews;
    }

    /**
     * Sanitize the thread title.
     *
     * @param string $title
     * @return string
     */
    private function sanitizeTitle(string $title)
    {
        // Trim whitespace from the beginning and end
        $title = trim($title);

        // Convert special characters to HTML entities
        $title = htmlspecialchars($title, ENT_QUOTES, 'UTF-8');

        // Remove any potentially harmful HTML tags
        $title = strip_tags($title);

        // Normalize spaces (convert multiple spaces to single space)
        $title = preg_replace('/\s+/', ' ', $title);

        // Trim again after other sanitization steps
        $title = trim($title);

        return $title;
    }

    /**
     * Validate input data for fetching featured posts.
     *
     * @param array $data
     * @return array
     * @throws ValidationException
     */
    private function validateData($key, array $data)
    {
        $rules = [
            'get' => [
                'limit' => 'nullable|integer|min:1|max:100'
            ],
            'create' => [
                'category_id' => 'required|integer|exists:categories,id',
                'title' => 'required|string|max:255',
                'content' => 'required|string',
                'user_id' => 'required|integer'
            ],
            'update' => [
                'category_id' => 'required|integer|exists:categories,id',
                'title' => 'required|string|max:255',
                'content' => 'required|string',
                'user_id' => 'required|integer'
            ]
        ];

        return validator($data, $rules[$key])->validate();
    }
}
