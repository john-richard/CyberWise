<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\UserService;
use App\Services\FeaturedThreadService;
use App\Services\CategoryService;
use App\Services\ThreadService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    protected $featuredThreadService;
    protected $threadService;
    protected $userService;
    protected $categoryService;

    public function __construct(
        FeaturedThreadService $featuredThreadService,
        ThreadService $threadService,
        UserService $userService,
        CategoryService $categoryService
    ) {
        $this->featuredThreadService = $featuredThreadService;
        $this->threadService = $threadService;
        $this->userService = $userService;
        $this->categoryService = $categoryService;
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
        \Log::info(" featuredThreads !!>>> " . print_r($featuredThreads['data']['featuredThreads'], 1));
        
        $filters = [
            'sortBy' => ['sortBy', 'latest'], // Default to 'latest'
        ];

        // get threads
        $threads = $this->threadService->getThreadsWithFilters($perPage, $filters);

        // get users
        $users = $this->userService->getUsersWithFilter($perPage, $filters);

        return view('dashboard', [
            'user' => $user, 
            'featuredThreads' => $featuredThreads['data'], 
            'users' => $users, 
            'threads' => $threads
        ]);
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

        // Return the view with paginated threads
        return view('admin.featured-thread', [
            'user' => $user,
            'featuredThreads' => $featuredThreads['data'],
            'pagination' => $featuredThreads['pagination']
        ]);

    }

    public function getLearningHub(Request $request)
    {
        $user = Auth::user(); 

        // Check if user is authenticated
        if (!$user) {
            return response()->json(['error' => 'Unauthorized. Please log in.'], 401);
        }

        $perPage = $request->get('per_page', 5); // Default per-page value

        $filters = [
            'search' => $request->query('search', '')
        ];


        // get categories 
        $categories = $this->categoryService->getCategories([
            'conditions' => ['status' => true, 'community_display' => false],
            'limit' => 0,
            'sort' => ['name', 'desc'], // Correct sorting
        ]);


        // get learning hub threads
        $threads = $this->featuredThreadService->getLearningHubWithFilters($perPage, $filters);

        \Log::info(" >>>> ". print_r($filters, 1));

        return view('admin.learning-hub', 
         [
            'user' => $user,
            'featuredThreads' => $threads,
            'filters' => $filters,
            'categories' => $categories
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

    public function getUsers(Request $request)
    {

        $user = Auth::user(); 

        // Check if user is authenticated
        if (!$user) {
            return response()->json(['error' => 'Unauthorized. Please log in.'], 401);
        }

        $type = $request->query('type', '');

        $perPage = $request->get('per_page', 10); // Default per-page value

        $filters = [
            'sortBy' => ['sortBy', 'latest'], // Default to 'latest'
            'where' => []
        ];

        // identify user type filtering
        if ($type === 'admin') {
            $filters['where']['users.role'] = 1; // Role 1 for admin users
        } elseif ($type === 'member') {
            $filters['where']['users.role'] = 2; // Role 2 for regular users
        }

        // get users
        $users = $this->userService->getUsersWithFilter($perPage, $filters);

        return view('admin.users', [
            'user' => $user, 
            'users' => $users,
            'type' => $type
        ]);
    }

}
