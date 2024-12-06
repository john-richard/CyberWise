<?php

namespace App\Repositories;

use App\Models\Comment;

class CommentRepository
{
    public function store(array $data)
    {
        return Comment::create($data);
    }

    public function delete(int $id, int $userId)
    {
        $comment = Comment::where('id', $id)->where('user_id', $userId)->first();

        if ($comment) {
            $comment->delete();
            return true;
        }

        return false;
    }
}
