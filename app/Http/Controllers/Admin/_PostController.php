<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\PostService;
use Illuminate\Http\Request;

class _PostController extends Controller
{
    protected $postService;

    public function __construct(PostService $postService)
    {
        $this->postService = $postService;
    }

    public function getFeaturedPosts(Request $request)
    {
        $featuredPosts = $this->postService->getFeaturedPosts($request->all());

        return response()->json([
            'message' => 'Featured posts fetched successfully',
            'data' => $featuredPosts,
        ]);
    }

    public function addFeaturedPost(Request $request)
    {
        // Call the service to add a featured post
        $post = $this->postService->addFeaturedPost($request->all());

        return response()->json(['message' => 'Post added successfully', 'post' => $post], 201);
    }

    public function updateFeaturedPost(Request $request, $id)
    {
        // Call the service to update the featured post
        $post = $this->postService->updateFeaturedPost($id, $request->all());

        return response()->json(['message' => 'Post updated successfully', 'post' => $post]);
    }

    public function deleteFeaturedPost($id)
    {
        // Call the service to deactivate (soft delete) the featured post
        $this->postService->deactivateFeaturedPost($id);

        return response()->json(['message' => 'Post deactivated successfully']);
    }
}
