<?php

namespace App\Http\Controllers;

use App\Services\ThreadService;
use Illuminate\Http\Request;

class CommunityController extends Controller
{
    protected $threadService;

    /**
     * CommunityController constructor.
     *
     * @param ThreadService $threadService
     */
    public function __construct(ThreadService $threadService)
    {
        $this->threadService = $threadService;
    }

    /**
     * Display threads with dynamic filters.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        $excludedCategoryId = 6; // Example category to exclude (featured post)
        $perPage = $request->get('per_page', 5); // Default per-page value

        $filters = [
            'sortBy' => $request->query('sortBy', 'latest'), // Default to 'latest'
        ];


        $threads = $this->threadService->getThreadsWithFilters($excludedCategoryId, $perPage, $filters);

        return view('community', compact('threads', 'filters'));
    }
}
