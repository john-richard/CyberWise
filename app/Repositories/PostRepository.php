<?php

namespace App\Repositories;

use App\Models\User;

class UserRepository
{
    public function getAllUsers()
    {
        return User::all();
    }

    public function findUserById($id)
    {
        return User::find($id);
    }

    public function createUser(array $data)
    {
        return User::create($data);
    }

    public function updateUser($id, array $data)
    {
        $user = $this->findUserById($id);

        if ($user) {
            $user->update($data);
            return $user;
        }

        return null;
    }

    public function deleteUser($id)
    {
        $user = $this->findUserById($id);

        if ($user) {
            $user->delete();
            return true;
        }

        return false;
    }
}
