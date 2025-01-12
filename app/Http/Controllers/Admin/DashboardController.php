<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\UserService;
use App\Services\FeaturedThreadService;
use App\Services\ThreadService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    protected $featuredThreadService;
    protected $threadService;
    protected $userService;

    public function __construct(
        FeaturedThreadService $featuredThreadService,
        ThreadService $threadService,
        UserService $userService
    ) {
        $this->featuredThreadService = $featuredThreadService;
        $this->threadService = $threadService;
        $this->userService = $userService;
    }

    public function index()
    {

        $user = Auth::user(); 

        // Check if user is authenticated
        if (!$user) {
            return response()->json(['error' => 'Unauthorized. Please log in.'], 401);
        }

        $perPage = 5; // Default per-page value

        $featuredThreads = $this->featuredThreadService->getFeaturedThreads([ 'limit' => $perPage ]);

        
        $filters = [
            'sortBy' => ['sortBy', 'latest'], // Default to 'latest'
        ];

        // get threads
        $threads = $this->threadService->getThreadsWithFilters($perPage, $filters);

        // get users
        $users = $this->userService->getUsersWithFilter($perPage, $filters);

        return view('dashboard', compact('user', 'featuredThreads', 'users', 'threads'));
    }

    public function getFeaturedThreads(Request $request)
    {
        $user = Auth::user(); 

        // Check if user is authenticated
        if (!$user) {
            return response()->json(['error' => 'Unauthorized. Please log in.'], 401);
        }

        $perPage = 3; // Default per-page value
        $featuredThreads = $this->featuredThreadService->getFeaturedThreads([ 'limit' => $perPage ]);

        \Log::info(" featuredThreads >>> " . print_r($featuredThreads, 1));


        // Return the view with paginated threads
        return view('admin.featured-thread', [
            'user' => $user,
            'featuredThreads' => $featuredThreads['data'],
            'pagination' => $featuredThreads['pagination']
        ]);

    }

    public function getThreads(Request $request)
    {
        $user = Auth::user(); 

        // Check if user is authenticated
        if (!$user) {
            return response()->json(['error' => 'Unauthorized. Please log in.'], 401);
        }

        $perPage = $request->get('per_page', 5); // Default per-page value

        $filters = [
            'sortBy' => $request->query('sortBy', 'latest'), // Default to 'latest'
        ];


        $threads = $this->threadService->getThreadsWithFilters($perPage, $filters);

        return view('admin.threads', 
         [
            'user' => $user,
            'threads' => $threads,
            'filters' => $filters
        ]);
    }
}
