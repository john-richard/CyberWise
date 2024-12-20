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
        $request->validate([
            'thread_id' => 'required|string',
            'content' => 'required|string',
        ]);

        $posts = $this->postService->storePost([
            'thread_id' => $request->thread_id,
            'user_id' => $request->user()->id,
            'content' => $request->post,
        ]);

        return response()->json([
            'message' => 'Post added successfully',
            'data' => $posts,
        ], 201);
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
