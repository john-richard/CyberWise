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

        // get categories 
        $categories = $this->categoryService->getCategories([
            'conditions' => [
                'status' => true,
                'community_display' => false,
                'id' => 6 // Featured thread category
            ],
            'limit' => 0,
            'sort' => ['name', 'desc'], // Correct sorting
        ]);

        // Return the view with paginated threads
        return view('admin.featured-thread', [
            'user' => $user,
            'featuredThreads' => $featuredThreads['data'],
            'pagination' => $featuredThreads['pagination'],
            'categories' => $categories
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

        $filters = [];
        $sanitizedSearch = $this->sanitizeSearchInput($request->query('search'));

        if ($sanitizedSearch !== null) {
            $filters['search'] = $sanitizedSearch;
        }


        // get categories 
        $categories = $this->categoryService->getCategories([
            'conditions' => [
                'status' => true,
                'community_display' => false,
                'id' => 7 // Learning hub category
            ],
            'limit' => 0,
            'sort' => ['name', 'desc'], // Correct sorting
        ]);


        // get learning hub threads
        $threads = $this->featuredThreadService->getLearningHubWithFilters($perPage, $filters);

        \Log::info(" >>>> ". print_r($threads, 1));

        return view('admin.learning-hub', 
         [
            'user' => $user,
            'featuredThreads' => $threads,
            'filters' => $filters,
            'categories' => $categories
        ]);

    }

    public function getTestYourKnowledge(Request $request)
    {
        $user = Auth::user(); 

        // Check if user is authenticated
        if (!$user) {
            return response()->json(['error' => 'Unauthorized. Please log in.'], 401);
        }

        $perPage = $request->get('per_page', 20); // Default per-page value

        $filters = [];
        $sanitizedSearch = $this->sanitizeSearchInput($request->query('search'));

        if ($sanitizedSearch !== null) {
            $filters['search'] = $sanitizedSearch;
        }

        // get categories 
        $categories = $this->categoryService->getCategories([
            'conditions' => [
                'status' => true, 
                'community_display' => false,
                'id' => 8 // Test your knowledge category
            
            ],
            'limit' => 0,
            'sort' => ['name', 'desc'], // Correct sorting
        ]);


        // get learning hub threads
        $threads = $this->featuredThreadService->getTestYourKnowledgeWithFilters($perPage, $filters);
        
        return view('admin.knowledge', 
         [
            'user' => $user,
            'featuredThreads' => $threads,
            'filters' => $filters,
            'categories' => $categories
        ]);

    }  

    public function getSelfAssessment(Request $request)
    {
        $user = Auth::user(); 

        // Check if user is authenticated
        if (!$user) {
            return response()->json(['error' => 'Unauthorized. Please log in.'], 401);
        }

        $perPage = $request->get('per_page', 20); // Default per-page value


        $filters = [];
        $sanitizedSearch = $this->sanitizeSearchInput($request->query('search'));

        if ($sanitizedSearch !== null) {
            $filters['search'] = $sanitizedSearch;
        }

        // get categories 
        $categories = $this->categoryService->getCategories([
            'conditions' => [
                'status' => true, 
                'community_display' => false,
                'id' => 9 // Self Assessment category
            
            ],
            'limit' => 0,
            'sort' => ['name', 'desc'], // Correct sorting
        ]);


        // get learning hub threads
        $threads = $this->featuredThreadService->getSelfAssessmentWithFilters($perPage, $filters);
        
        return view('admin.self-assessment', 
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
