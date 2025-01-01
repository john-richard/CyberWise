<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Services\ThreadService;
use App\Services\CategoryService;
use Illuminate\Http\Request;

class ThreadController extends Controller
{
    protected $threadService;
    protected $categoryService;

    public function __construct(
        ThreadService $threadService,
        CategoryService $categoryService
    ) {
        $this->threadService = $threadService;
        $this->categoryService = $categoryService;
    }
    
    public function index()
    {
        try {
            $categories = $this->categoryService->getCategories([
                'conditions' => ['status' => true, 'community_display' => true],
                'limit' => 0,
                'sort' => ['name', 'asc'], // Correct sorting
            ]);

            return view('thread', compact('categories'));
        } catch (\Exception $e) {
            \Log::error("Error fetching categories: " . $e->getMessage());
            return redirect()->route('home')->with('error', 'Unable to load threads.');
        }
    }

    public function getThreads(Request $request)
    {
        $threads = $this->threadService->getThreads($request->all());

        return response()->json([
            'message' => 'Threads fetched successfully',
            'data' => $threads,
        ]);
    }

    public function createThread(Request $request)
    {
        try {
            if (!auth()->check()) {
                \Log::info('User is not authenticated');
                return response()->json(['error' => 'Unauthorized'], 401);
            }

            // Call the service to add a threads
            $response = $this->threadService->createThread($request->all());

            if (isset($response['error'])) {
                return response()->json($response, 401);
            }
            return response()->json($response, 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }

    /**
     * Display a specific thread.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function showThread(Request $request)
    {
        try {
            $threadId = $request->route('id');
            $threadName = $request->route('thread_name');

            $thread = $this->threadService->showThread($threadId, $threadName);

            if (isset($thread['error'])) {
                return response()->json($thread, 401);
            }

            return view('show-thread', compact('thread'));

        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }

    public function updateThread(Request $request, $id)
    {
        // Call the service to add a threads
        $threads = $this->threadService->updateThread($id, $request->all());

        return response()->json(['message' => 'Threads added successfully', 'threads' => $threads], 201);
    }

}