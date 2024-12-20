<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Services\ThreadService;
use Illuminate\Http\Request;

class ThreadController extends Controller
{
    protected $threadService;

    public function __construct(ThreadService $threadService)
    {
        $this->threadService = $threadService;
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
        // Call the service to add a threads
        $threads = $this->threadService->createThread($request->all());

        return response()->json(['message' => 'Threads added successfully', 'threads' => $threads], 201);
    }

    public function updateThread(Request $request, $id)
    {
        // Call the service to add a threads
        $threads = $this->threadService->updateThread($id, $request->all());

        return response()->json(['message' => 'Threads added successfully', 'threads' => $threads], 201);
    }

}