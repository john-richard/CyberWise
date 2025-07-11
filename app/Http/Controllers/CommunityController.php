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
        $perPage = $request->get('per_page', 5); // Default per-page value

        $filters = [
            'sortBy' => $request->query('sortBy', 'latest'), // Default to 'latest'
        ];

        $sanitizedSearch = $this->sanitizeSearchInput($request->query('search'));

        if ($sanitizedSearch !== null) {
            $filters['search'] = $sanitizedSearch;
        }

        $threads = $this->threadService->getThreadsWithFilters($perPage, $filters);

        return view('community', 
        [
           'threads' => $threads,
           'filters' => $filters
        ]);
    }

    /**
     * Sanitize the search input to prevent XSS or invalid queries.
     *
     * @param string|null $input
     * @return string|null
     */
    private function sanitizeSearchInput(?string $input): ?string
    {
        if (!$input) {
            return null;
        }

        $input = substr($input, 0, 100); // Limit length to 100 chars
        $input = strip_tags($input); // Remove HTML tags
        $input = trim($input); // Trim spaces
        $input = preg_replace('/\s+/', ' ', $input); // Normalize multiple spaces

        return !empty($input) ? $input : null;
    }
}
