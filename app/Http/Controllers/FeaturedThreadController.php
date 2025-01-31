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

    // community learning hub display
    public function showLearningHub(Request $request)
    {
        $perPage = 100; // Default per-page value

        $filters = [
            'search' => $request->query('search', ''),
            'orderBy' => ['featured_threads.id', 'ASC']
        ];

        // get learning hub threads
        $threads = $this->featuredThreadService->getLearningHubWithFilters($perPage, $filters);


        $threadsArray = $threads->items();
        if (!empty($threadsArray) && isset($threadsArray[0])) {
            $threadTitle = $threadsArray[0]->thread_title;
        } else {
            $threadTitle = 'No threads available'; // Provide a fallback value
        }

        return view('learning-hub', 
        [
           'featuredThreads' => $threads,
           'threadTitle' => $threadTitle,
           'filters' => $filters
        ]);
    }

    public function createLearningHub(Request $request)
    {
        // Call the service to add learning hub
        $response = $this->featuredThreadService->createLearningHub($request->all());
        if (isset($response['error'])) {
            return response()->json($response, 401);
        }
        return response()->json($response, 200);
    }

    public function updateLearningHub(Request $request, $id)
    {
        // Call the service to update learning hub
        $response = $this->featuredThreadService->updateLearningHub($id, $request->all());

        if (isset($response['error'])) {
            return response()->json($response, 401);
        }
        return response()->json($response, 200);
    }

    public function deleteLearningHub($id)
    {
        // Call the service to delete learning hub
        $response = $this->featuredThreadService->deleteLearningHub($id);

        if (isset($response['error'])) {
            return response()->json($response, 401);
        }
        return response()->json($response, 200);
    }
}