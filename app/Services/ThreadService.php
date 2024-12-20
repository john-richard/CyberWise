<?php

namespace App\Services;

use App\Models\Category;
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
    public function getThreadsWithFilters(int $excludedCategoryId, int $perPage = 20, array $filters = [])
    {
        return $this->threadRepository->getThreadsWithFilters($excludedCategoryId, $perPage, $filters);
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

        // Validate input data
        $this->validateData('create', $data);

        // Create a thread
        $thread = Thread::create($data);

        return $thread;
    }

    public function updateThread($id, array $data)
    {
        // Validate the incoming data
        $this->validateData('update', $data);

        // Find the top post by ID and update it
        $thread = Thread::findOrFail($id);
        $thread->update([
            'title' => $data['title'],
            'link' => $data['link'],
            'description' => $data['description'] ?? null,
        ]);

        return $thread;
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
