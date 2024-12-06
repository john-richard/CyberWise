<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\UserService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function index()
    {
        // Fetch all users via service
        $users = $this->userService->getAllUsers();
    
        if ($users->isEmpty()) {
            return response()->json(['message' => 'No users found'], 404); // 404 Not Found
        }
    
        return response()->json($users);
    }

    public function store(Request $request)
    {
        try {
            // Call the service to handle validation and user creation
            $user = $this->userService->createUser($request);
    
            // Return response with the created user
            return response()->json(['message' => 'User created successfully', 'user' => $user], 201);
        } catch (\Exception $e) {
            // Catch any errors and return an appropriate response
            return response()->json(['message' => 'Error creating user', 'error' => $e->getMessage()], 500);
        }
    }

    public function show($id)
    {
        // Get user by ID via service
        $user = $this->userService->getUserById($id);

        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        return response()->json($user);
    }

    public function update(Request $request, $id)
    {
        try {
            // Call the service to handle validation and user update
            $user = $this->userService->updateUser($id, $request);
    
            // Return response with the updated user
            return response()->json(['message' => 'User updated successfully', 'user' => $user]);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error updating user', 'error' => $e->getMessage()], 500);
        }
    }

    public function delete($id)
    {
        try {
            // Call the service to handle user deletion
            $deleted = $this->userService->deleteUser($id);
    
            if (!$deleted) {
                return response()->json(['message' => 'User not found'], 404);
            }
    
            return response()->json(['message' => 'User deleted successfully']);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error deleting user', 'error' => $e->getMessage()], 500);
        }
    }
}
