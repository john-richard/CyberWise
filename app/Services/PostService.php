<?php

namespace App\Services;

use App\Models\Thread;
use App\Models\TopPost;
use App\Models\FeaturedPost;
use App\Models\Post;
use App\Repositories\PostRepository;
use App\Repositories\FeaturedPostRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class PostService
{
    protected $featuredPostRepository;

    protected $postRepository;

    public function __construct(
        FeaturedPostRepository $featuredPostRepository,
        PostRepository $postRepository
    ) {
        $this->featuredPostRepository = $featuredPostRepository;
        $this->postRepository = $postRepository;
    }

    public function storePost($threadId, array $data)
    {

        $user = Auth::user(); 

        // Check if user is authenticated
        if (!$user) {
            return response()->json(['error' => 'Unauthorized. Please log in.'], 401);
        }

        $payload = [
            'user_id' => $user->id,
            'thread_id' => $threadId,
            'content' => $data['content']
        ];

        // Validate the incoming data
        $this->validateData('create-post', $payload);


        // create post
        $post = Post::create($payload);

        // retrived post
        $response = $this->postRepository->getPostById($post->id);

        \Log::info("RESPONSE >> " . print_r($response, 1));

        return $response;
    }

    /**
     * Fetch a dynamic number of featured posts with related data.
     *
     * @param array $data
     * @return \Illuminate\Database\Eloquent\Collection
     * @throws ValidationException
     */
    public function getFeaturedPosts(array $data)
    {
        // Validate input data
        $validated = $this->validateData('get-featured-posts', $data);
    
        $limit = $validated['limit'] ?? 5; // Default limit if not provided
    
        // Fetch the featured posts with the required conditions
        return $this->featuredPostRepository->getFeaturedPosts(['status' => true], $limit);
    }
    
    public function addFeaturedPost(array $data)
    {
        // Validate the incoming data
        $this->validateFeaturedPostData($data);

        // Create a thread for the Top Post
        $thread = Thread::create([
            'title' => $data['title'],
            //'content' => $data['description'] ?? 'This thread was created for a featured post.',
            'user_id' => 7 //auth()->id(), // Or specify the admin user ID
        ]);

        // Create the Top Post linked to the thread
        $topPost = TopPost::create([
            'title' => $data['title'],
            'link' => $data['link'],
            'description' => $data['description'],
            'thread_id' => $thread->id, // Link to the newly created thread
        ]);

        // Optionally, mark the post as a Featured Post
        FeaturedPost::create([
            'top_post_id' => $topPost->id,
            'thread_id' => $thread->id,
        ]);

        return $topPost;
    }

    public function updateFeaturedPost($id, array $data)
    {
        // Validate the incoming data
        $this->validateFeaturedPostData($data);

        // Find the top post by ID and update it
        $post = TopPost::findOrFail($id);
        $post->update([
            'title' => $data['title'],
            'link' => $data['link'],
            'description' => $data['description'] ?? null,
        ]);

        return $post;
    }

    public function deactivateFeaturedPost($id)
    {
        // Find the top post and update its status
        $post = TopPost::findOrFail($id);
        $post->update(['status' => false]);

        return $post;
    }

    private function validateFeaturedPostData(array $data)
    {
        // Add validation logic here (can be customized based on your needs)
        if (empty($data['title']) || empty($data['link'])) {
            throw new ValidationException("Title and Link are required.");
        }
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
            'get-featured-posts' => [
                'limit' => 'nullable|integer|min:1|max:100'
            ],
            'create-post' => [
                'thread_id' => 'required|integer|exists:threads,id',
                'content' => 'required|string',
                'user_id' => 'required|integer|exists:users,id'
            ]
        ];

        return validator($data, $rules[$key])->validate();
    }

}
