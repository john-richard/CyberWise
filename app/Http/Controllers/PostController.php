<?php

namespace App\Http\Controllers;

use App\Services\PostService;
use Illuminate\Http\Request;

class PostController extends Controller
{
    protected $postService;

    public function __construct(PostService $postService)
    {
        $this->postService = $postService;
    }

    // Store posts for authenticated users
    public function store(Request $request)
    {
        try {
            if (!auth()->check()) {
                \Log::info('User is not authenticated');
                return response()->json(['error' => 'Unauthorized'], 401);
            }
            $threadId = $request->route('id');

            $response = $this->postService->storePost($threadId, $request->all());
    
            if (isset($response['error'])) {
                return response()->json($response, 401);
            }
            return response()->json($response, 200);

        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }

    // Delete posts for authenticated users
    public function destroy(Request $request, $id)
    {
        $deleted = $this->postService->deletePost($id, $request->user()->id);

        if ($deleted) {
            return response()->json(['message' => 'Post deleted successfully'], 200);
        }

        return response()->json(['message' => 'Post not found or unauthorized'], 404);
    }
}
