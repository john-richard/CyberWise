<?php

namespace App\Services;
use App\Models\User;
use App\Mail\ResetPasswordMail;
use App\Repositories\UserRepository;
use App\Repositories\AuthRepository;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\ValidationException;
use Carbon\Carbon;

class AuthService
{
    protected $userRepository;
    protected $authRepository;

    public function __construct(UserRepository $userRepository, AuthRepository $authRepository)
    {
        $this->userRepository = $userRepository;
        $this->authRepository = $authRepository;
    }

    public function register(array $data)
    {
        // Validation
        $validator = Validator::make($data, [
            'username' => 'required|string|max:100|unique:users',
            'email' => 'required|email|max:100|unique:users',
            'password' => [
                'required',
                Password::min(8)
                    ->mixedCase()
                    ->numbers()
                    ->symbols()
                    ->uncompromised()
            ],
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validate avatar file
        ]);
    
        if ($validator->fails()) {
            throw new ValidationException($validator);
        }
    
        // Handle file upload
        $avatarPath = null;
        if (isset($data['avatar'])) {
            $avatarPath = $data['avatar']->store('assets/img/avatar', 'public'); // Save in public/assets/img/avatar
        }
    
        // Create the user
        $user = User::create([
            'username' => $data['username'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'role' => 2, // User role
            'avatar' => $avatarPath, // Save avatar path in the database
        ]);
    
        // Generate Bearer Token for the newly created user
        $token = $user->createToken('API Token')->plainTextToken;
    
        return [
            'token' => $token,
            'token_type' => 'Bearer',
            'user' => $user,
            'redirect_url' => '/',
        ];
    }    

    public function login(array $data)
    {
        // Validation
        $validator = Validator::make($data, [
            'username' => 'required|string',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }

        // Attempt Login
        if (!Auth::attempt(['username' => $data['username'], 'password' => $data['password']])) {
            return ['error' => 'Your username or password is invalid.'];
        }

        // Generate Bearer Token
        $user = Auth::user();
        $token = $user->createToken('API Token')->plainTextToken;

        // Redirect based on role
        if ($user->role == 1) {  // Admin
            $redirectUrl = '/dashboard';
        } elseif ($user->role == 2) {  // Regular User
            $redirectUrl = '/';
        } else {
            $redirectUrl = '/';  // Default redirect URL if role is not defined
        }

        $response = [
            'token' => $token,
            'token_type' => 'Bearer',
            'user' => $user,
            'redirect_url' => $redirectUrl,  // Include redirect URL in the response
        ];
        
        return $response;
    }

    public function logout($user)
    {
        $user->tokens()->delete();
        return ['message' => 'Logged out successfully'];
    }    

    public function sendResetLink($email)
    {
        // Check if the user exists
        $user = $this->authRepository->findUserByEmail($email);
        if (!$user) {
            return ['status' => false, 'message' => 'Email not found'];
        }

        // Generate reset token
        $token = Str::random(60);
        $this->authRepository->storeResetToken($email, $token);

        // Generate reset link
        $resetUrl = url('/password/reset/' . $token . '?email=' . urlencode($email));

        // Send email
        Mail::to($email)->send(new ResetPasswordMail($resetUrl));

        return ['status' => true, 'message' => 'Password reset link sent!'];
    }

    public function resetPassword($email, $token, $newPassword)
    {
        // Validate token
        $resetData = $this->authRepository->getResetToken($email);
        if (!$resetData || !password_verify($token, $resetData->token)) {
            return ['status' => false, 'message' => 'Invalid or expired token'];
        }

        // Update password
        $this->authRepository->updateUserPassword($email, $newPassword);

        // Delete token after successful reset
        $this->authRepository->deleteResetToken($email);

        return ['status' => true, 'message' => 'Password has been reset successfully'];
    }
}
