<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class AuthRepository
{
    public function createUser(array $data)
    {
        return User::create($data);
    }

    public function findUserByEmail(string $email)
    {
        return User::where('email', $email)->first();
    }

    public function storeResetToken($email, $token)
    {
        return DB::table('password_resets')->updateOrInsert(
            ['email' => $email],
            [
                'token' => Hash::make($token),
                'created_at' => Carbon::now(),
            ]
        );
    }

    public function getResetToken($email)
    {
        return DB::table('password_resets')->where('email', $email)->first();
    }

    public function deleteResetToken($email)
    {
        return DB::table('password_resets')->where('email', $email)->delete();
    }

    public function updateUserPassword($email, $password)
    {
        return DB::table('users')
            ->where('email', $email)
            ->update(['password' => Hash::make($password)]);
    } 
}
