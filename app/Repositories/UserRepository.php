<?php

namespace App\Repositories;

use App\Models\User;
use DB;

class UserRepository
{
    public function getAllUsers()
    {
        return User::all();
    }

    /**
     * Get users with dynamic filters and pagination.
     *
     * @param int $perPage
     * @param array $filters
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getUsersWithFilters(int $perPage = 20, array $filters = [])
    {
        // Start building the query
        $query = DB::table('users');
    
        // Apply sorting filters
        if (!empty($filters['sortBy'])) {
            switch ($filters['sortBy']) {
                case 'latest':
                    $query->orderBy('created_at', 'desc');
                    break;

                case 'active':
                    $query->where('status', 1);
                    break;
    
                case 'inactive':
                    $query->where('status', 0);
                    break;

                default:
                    $query->orderBy('created_at', 'desc'); // Default to latest
                    break;
            }
        }
    
        // Add select fields
        $query->select(
            'users.id as user_id',
            'users.username',
            'users.email',
            'users.avatar',
            'users.created_at',
            DB::raw("TO_CHAR(users.created_at, 'Mon DD, YYYY') as created_date"),
            'users.role',
            'users.status'
        );
    
        // Paginate results
        $users = $query->paginate($perPage);
        
        return $users;
    }

    public function findByEmail($email)
    {
        return User::where('email', $email)->first();
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
