<?php

namespace App\Services;

use App\Repositories\CommentRepository;

class CommentService
{
    protected $commentRepository;

    public function __construct(CommentRepository $commentRepository)
    {
        $this->commentRepository = $commentRepository;
    }

    public function storeComment(array $data)
    {
        return $this->commentRepository->store($data);
    }

    public function deleteComment(int $id, int $userId)
    {
        return $this->commentRepository->delete($id, $userId);
    }
}
