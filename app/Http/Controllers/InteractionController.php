<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Like;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class InteractionController extends Controller
{
    //

    public function likePost($postId)
    {
        try{
            $post = Post::findOrFail($postId);
            $like = Like::create(['post_id' => $postId]);
            return response()->json($like, 201);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'message' => 'Blog not Found',
            ], 404);
        }
    }

    public function commentOnPost(Request $request, $postId)
    {
        try{
            $post = Post::findOrFail($postId);
            $validated = $request->validate([
                'comment' => 'required|string',
            ]);

            $comment = Comment::create([
                'post_id' => $postId,
                'comment' => $validated['comment'],
            ]);

            return response()->json($comment, 201);
        } catch (ValidationException $e) {
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $e->errors(),
            ], 422);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'message' => 'Blog not Found',
            ], 404);
        }
    }
}
