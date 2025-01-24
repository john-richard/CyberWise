<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Services\FeaturedThreadService;
use Illuminate\Http\Request;

class FeaturedThreadController extends Controller
{
    protected $featuredThreadService;

    public function __construct(FeaturedThreadService $featuredThreadService)
    {
        $this->featuredThreadService = $featuredThreadService;
    }

    public function getFeaturedThreads(Request $request)
    {
        $threads = $this->featuredThreadService->getFeaturedThreads($request->all());

        return response()->json([
            'message' => 'Featured Threads fetched successfully',
            'data' => $threads,
        ]);
    }

    public function createFeaturedThread(Request $request)
    {
        // Call the service to add a threads
        $threads = $this->featuredThreadService->createFeaturedThread($request->all());

        return response()->json(['message' => 'Featured Thread added successfully', 'threads' => $threads], 201);
    }

    // public function updateFeaturedPost(Request $request, $id)
    // {
    //     // Call the service to update the featured post
    //     $post = $this->postService->updateFeaturedPost($id, $request->all());

    //     return response()->json(['message' => 'Post updated successfully', 'post' => $post]);
    // }

    // public function deleteFeaturedPost($id)
    // {
    //     // Call the service to deactivate (soft delete) the featured post
    //     $this->postService->deactivateFeaturedPost($id);

    //     return response()->json(['message' => 'Post deactivated successfully']);
    // }

    public function createLearningHub(Request $request)
    {
        $data = $request->all();

        // Call the service to add a learning hub
        $response = $this->featuredThreadService->createLearningHub($request->all());
        if (isset($response['error'])) {
            return response()->json($response, 401);
        }
        return response()->json($response, 200);
    }

    public function updateLearningHub(Request $request, $id)
    {
        // Call the service to add a threads
        $response = $this->featuredThreadService->updateLearningHub($id, $request->all());

        if (isset($response['error'])) {
            return response()->json($response, 401);
        }
        return response()->json($response, 200);
    }
}