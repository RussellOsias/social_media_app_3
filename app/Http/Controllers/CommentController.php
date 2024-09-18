<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\Post;

class CommentController extends Controller
{
    public function store(Request $request, $postId)
    {
        $request->validate([
            'comment' => 'required|string|max:255',
        ]);

        $post = Post::findOrFail($postId);

        $comment = new Comment();
        $comment->post_id = $post->id;
        $comment->user_id = auth()->id(); // Assuming the user is authenticated
        $comment->comment = $request->input('comment');
        $comment->save();

        return response()->json($comment, 201); // Return the created comment
    }
}