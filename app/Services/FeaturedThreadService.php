<?php

namespace App\Services;


use App\Models\FeaturedThread;
use App\Models\Thread;
use App\Models\Category;
use App\Repositories\ThreadRepository;
use App\Repositories\FeaturedThreadRepository;
use App\Repositories\CategoryRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Validator;

class FeaturedThreadService
{
    protected $threadRepository;
    protected $featuredThreadRepository;
    protected $categoryRepository;

    public function __construct(
        ThreadRepository $threadRepository,
        FeaturedThreadRepository $featuredThreadRepository,
        CategoryRepository $categoryRepository
    ) {
        $this->threadRepository = $threadRepository;
        $this->featuredThreadRepository = $featuredThreadRepository;
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * Fetch a dynamic number of featured posts with related data.
     *
     * @param array $data
     * @return \Illuminate\Database\Eloquent\Collection
     * @throws ValidationException
     */
    public function getFeaturedThreads(array $data)
    {
        // Validate input data
        $this->validateData('get', $data);

        // Get the "Featured Thread" category
        $category = Category::where('name', 'Featured Thread')->first();

        if (!$category) {
            return [];
        }

        // Fetch threads and their featured threads
        $threads = $category->threads()
            ->where('status', true) // Threads with status = true
            ->with(['featuredThreads' => function ($query) {
                $query->where('status', true); // Featured threads with status = true
            }])
            ->paginate($data['limit']);

        // Transform paginated result into the desired format
        $result = $threads->map(function ($thread) {
            return [
                'title' => $thread->title,
                'user_id' => $thread->user_id,
                'featuredThreads' => $thread->featuredThreads->map(function ($featuredThread) {
                    return [
                        'id' => $featuredThread->id,
                        'title' => $featuredThread->title,
                        'content' => $featuredThread->content,
                        'status' => $featuredThread->status,
                        'link' => $featuredThread->link,
                    ];
                })->toArray(),
            ];
        })->toArray();

        // Include pagination metadata
        return [
            'data' => $result[0],
            'pagination' => [
                'total' => $threads->total(),
                'per_page' => $threads->perPage(),
                'current_page' => $threads->currentPage(),
                'last_page' => $threads->lastPage(),
                'next_page_url' => $threads->nextPageUrl(),
                'prev_page_url' => $threads->previousPageUrl(),
            ],
        ];
    }
    
    /**
     * Create a new featured thread.
     *
     * @param  array  $data
     * @return \App\Models\FeaturedThread
     */
    public function createFeaturedThread(array $data)
    {

        $user = Auth::user() ?: Auth::guard('sanctum')->user(); 

        // Check if user is authenticated
        if (!$user) {
            return response()->json(['error' => 'Unauthorized. Please log in.'], 401);
        }

        // Check if user is authenticated
        if ($user->role !== 1) {
            return response()->json(['error' => 'Admin access is required. Please log in with an authorized account'], 401);
        }

        $data['user_id'] = $user->id;

        // Validate input data
        $this->validateData('create', $data);

        // Ensure the thread exists and is active
        $thread = Thread::find($data['thread_id']);

        if (!$thread || $thread->status !== true) {
            throw new \Exception('Thread is either not found or inactive.');
        }

        // Create the featured thread
        return FeaturedThread::create([
            'thread_id' => $thread->id,
            'title' => $data['title'],
            'content' => $data['content'],
            'link' => $data['link'],
            'status' => true, // Default to true
            'order' => $data['order']
        ]);
    }

    // public function updateThread($id, array $data)
    // {
    //     // Validate the incoming data
    //     $this->validateData('update', $data);

    //     // Find the top post by ID and update it
    //     $thread = Thread::findOrFail($id);
    //     $thread->update([
    //         'title' => $data['title'],
    //         'link' => $data['link'],
    //         'description' => $data['description'] ?? null,
    //     ]);

    //     return $thread;
    // }

    public function getLearningHubWithFilters(int $perPage = 20, array $filters = [])
    {
        return $this->featuredThreadRepository->getLearningHubWithFilters($perPage, $filters);
    }

    /**
     * Create a new learning hub.
     *
     * @param  array  $data
     * @return \App\Models\FeaturedThread
     */
    public function createLearningHub(array $data)
    {
        $user = Auth::user() ?: Auth::guard('sanctum')->user(); 

        // Check if user is authenticated
        if (!$user) {
            return response()->json(['error' => 'Unauthorized. Please log in.'], 401);
        }

        // Check if user is authenticated
        if ($user->role !== 1) {
            return response()->json(['error' => 'Admin access is required. Please log in with an authorized account'], 401);
        }

        // Validate input data
        $this->validateData('create-hub', $data);

        // Ensure the category exists and is active
        $categoryThreads = $this->categoryRepository->getCategoryThreads(['categories.id' => $data['hubCategory']]);

        if (!$categoryThreads || $categoryThreads->status !== true) {
            throw new \Exception('Category is either not found or inactive.');
        }

        // Create the featured thread
        $thread = FeaturedThread::create([
            'thread_id' => $categoryThreads->thread_id,
            'title' => $data['hubTitle'],
            'content' => $data['hubContent'],
            'link' => $data['hubLink'],
            'status' => true, // Default to true
            'order' => 1
        ]);

        return [
            'data' => $thread,
            'redirect_url' => '/admin/learning-hub',
        ];
    }

    public function updateLearningHub($id, array $data)
    {
        $user = Auth::user() ?: Auth::guard('sanctum')->user(); 

        // Check if user is authenticated
        if (!$user) {
            return response()->json(['error' => 'Unauthorized. Please log in.'], 401);
        }

        // Check if user is authenticated
        if ($user->role !== 1) {
            return response()->json(['error' => 'Admin access is required. Please log in with an authorized account'], 401);
        }

        // Validate the incoming data
        $this->validateData('update-hub', $data);

        // Find the thread by ID and update it
        $thread = FeaturedThread::findOrFail($id);
        // Check if user is authenticated
        if (!$thread) {
            return response()->json(['error' => 'Featured thread not found.'], 404);
        }

        // Ensure the category exists and is active
        $categoryThreads = $this->categoryRepository->getCategoryThreads(['categories.id' => $data['hubCategory']]);

        if (!$categoryThreads || $categoryThreads->status !== true) {
            throw new \Exception('Category is either not found or inactive.');
        }

        // Find the thread by ID and update it
        $payload = [
            'thread_id' => $categoryThreads->thread_id,
            'title' => $data['hubTitle'],
            'content' => $data['hubContent'],
            'link' => $data['hubLink']
        ];

        $thread->update($payload);

        return [
            'data' => $thread,
            'redirect_url' => '/admin/learning-hub',
        ];
    }

    public function deleteLearningHub($id)
    {
        $user = Auth::user() ?: Auth::guard('sanctum')->user(); 

        // Check if user is authenticated
        if (!$user) {
            return response()->json(['error' => 'Unauthorized. Please log in.'], 401);
        }

        // Check if user is authenticated
        if ($user->role !== 1) {
            return response()->json(['error' => 'Admin access is required. Please log in with an authorized account'], 401);
        }

        // Find the thread by ID and update it
        $thread = FeaturedThread::findOrFail($id);

        // Check if user is authenticated
        if (!$thread) {
            return response()->json(['error' => 'Featured thread not found.'], 404);
        }
    
        // Perform soft delete (update status)
        $thread->status = false;
        $thread->updated_at = now();
        $thread->save();
        
        return [
            'data' => $thread,
            'redirect_url' => '/admin/learning-hub',
        ];
    }

    /**
     * Validate input data.
     *
     * @param  string  $key
     * @param  array  $data
     * @return void
     */
    private function validateData($key, array $data)
    {
        $rules = [
            'get' => [
                'limit' => 'nullable|integer|min:1|max:100'
            ],
            'create' => [
                'thread_id' => 'required|exists:threads,id',  // Ensure the thread exists
                'title' => 'required|string|max:255',
                'content' => 'nullable|string',
                'link' => 'nullable|url',
                'order' => 'required|integer|min:1'
            ],
            'update' => [
                'title' => 'required|string|max:255',
                'user_id' => 'required|integer'
            ],
            'create-hub' => [
                'hubCategory' => 'required|exists:categories,id',  // Ensure the category exists
                'hubTitle' => 'required|string|max:255',
                'hubContent' => 'nullable|string',
                'hubLink' => 'nullable|url'
            ],
            
            'update-hub' => [
                'hubCategory' => 'required|exists:categories,id',  // Ensure the category exists
                'hubTitle' => 'required|string|max:255',
                'hubContent' => 'nullable|string',
                'hubLink' => 'nullable|url'
            ],
        ];

        // Validate the data based on the rules
        $validator = Validator::make($data, $rules[$key]);

        if ($validator->fails()) {
            throw new \Exception('Validation failed: ' . implode(', ', $validator->errors()->all()));
        }
    }
}
