<?php

namespace App\Services;

use App\Models\User;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class UserService
{
    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }


    public function getAllUsers()
    {
        // Get all users
        return User::all();
    }

    public function getUsersWithFilter(int $perPage = 20, array $filters = [])
    {
        // Get all users w/ filter
        return $this->userRepository->getUsersWithFilters($perPage, $filters);
    }

    public function createUser($request)
    {
        // Validate the data before processing
        $validatedData = $this->validateUserData($request);
    
        // Prepare data for insertion
        $data = [
            'username' => $validatedData['username'],
            'email' => $validatedData['email'],
            'password' => bcrypt($validatedData['password']),
            // 'first_name' => $validatedData['first_name'],
            // 'last_name' => $validatedData['last_name'],
            'role' => $validatedData['role'],
        ];
    
        // Insert into database
        return User::create($data);
    }
    

    public function getUserById($id)
    {
        // Find user by ID
        return User::find($id);
    }

    public function updateUser($id, $request)
    {
        // Validate incoming data
        $validatedData = $this->validateUserData($request, $id);

        // Find the user and update
        $user = User::findOrFail($id);

        // Prepare data for insertion
        $data = [
            'username' => $validatedData['username'],
            'email' => $validatedData['email'],
            'password' => bcrypt($validatedData['password']),
            'first_name' => $validatedData['first_name'],
            'last_name' => $validatedData['last_name'],
            'role' => $validatedData['role'],
        ];

        $user->update($data);

        return $user;
    }

    public function deleteUser($id)
    {
        // Find the user by ID
        $user = User::find($id);
    
        if ($user) {
            // Perform soft delete (update deleted_at and status)
            $user->deleted_at = now();  // Use now() to set current timestamp
            $user->status = 0;  // 0 means the user is deactivated or deleted
            $user->updated_at = now();  // Update the 'updated_at' field
            
            if ($user->save()) {
                return response()->json(['message' => 'User soft deleted successfully'], 200);
            } else {
                return response()->json(['message' => 'Error soft deleting user'], 500);
            }
        }
    
        return response()->json(['message' => 'User not found'], 404);
    }

    private function validateUserData($request, $id = null)
    {
        // Dynamically build unique rules for email and username
        $uniqueEmailRule = 'unique:users,email';
        $uniqueUsernameRule = 'unique:users,username';
        
        if ($id) {
            $uniqueEmailRule .= ',' . $id;
            $uniqueUsernameRule .= ',' . $id;
        }
    
        // Validation logic for user data
        $validator = Validator::make($request->all(), [
            'username' => "required|string|max:100|{$uniqueUsernameRule}",
            'email' => "required|string|max:100|email|{$uniqueEmailRule}",
            'password' => $id ? 'nullable|string|min:8' : 'required|string|min:8|regex:#^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$#',
            // 'first_name' => 'required|string|min:2',
            // 'last_name' => 'required|string|min:2',
            'role' => 'required|integer|in:1,2',
        ]);
    
        // Check if validation fails
        if ($validator->fails()) {
            throw new ValidationException($validator);
        }
    
        // Return validated data
        return $validator->validated();
    }
    
}