<?php

namespace App\Http\Controllers;

use App\Services\CommentService;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    protected $commentService;

    public function __construct(CommentService $commentService)
    {
        $this->commentService = $commentService;
    }

    // Store comment for authenticated users
    public function store(Request $request)
    {
        $request->validate([
            'comment' => 'required|string',
        ]);

        $comment = $this->commentService->storeComment([
            'user_id' => $request->user()->id,
            'content' => $request->comment,
        ]);

        return response()->json([
            'message' => 'Comment added successfully',
            'data' => $comment,
        ], 201);
    }

    // Delete comment for authenticated users
    public function destroy(Request $request, $id)
    {
        $deleted = $this->commentService->deleteComment($id, $request->user()->id);

        if ($deleted) {
            return response()->json(['message' => 'Comment deleted successfully'], 200);
        }

        return response()->json(['message' => 'Comment not found or unauthorized'], 404);
    }
}
