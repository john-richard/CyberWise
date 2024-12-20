<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\AuthService;

class AuthController extends Controller
{
    protected $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function login(Request $request)
    {
        try {
            $response = $this->authService->login($request->all());
            if (isset($response['error'])) {
                return response()->json($response, 401);
            }
            return response()->json($response, 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }

    public function logout(Request $request)
    {
        $response = $this->authService->logout($request->user());
        return response()->json($response);
    }

    public function register(Request $request)
    {
        if ($request->hasFile('avatar')) {
            $mimeType = $request->file('avatar')->getMimeType();
            \Log::info('Uploaded File MIME Type: ' . $mimeType);
        } else {
            \Log::error('No file was uploaded.');
        }


        try {
            $response = $this->authService->register($request->all(), $request);
            if (isset($response['error'])) {
                return response()->json($response, 401);
            }
            return response()->json($response, 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }

    public function resetPassword(Request $request)
    {
        $this->authService->resetPassword($request->all());
        return response()->json(['message' => 'Password reset successfully'], 200);
    }
}
