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
}
