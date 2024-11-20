<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class PostController extends Controller
{
    //

    public function index($blogId)
    {
        try{
            $blog = Blog::findOrFail($blogId);
            $posts = Post::where('blog_id', $blogId)->with('likes', 'comments')->get();
            return response()->json($posts);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'message' => 'Blog not Found',
            ], 404);
        }
    }

    public function store(Request $request, $blogId)
    {
        try{
            $blog = Blog::findOrFail($blogId);

            $validated = $request->validate([
                'title' => 'required|string|max:255',
                'content' => 'required|string',
                'image_url' => 'nullable|url',
            ]);

            $validated['blog_id'] = $blogId;
            $post = Post::create($validated);
            return response()->json($post, 201);
        } catch (ValidationException $e) {
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $e->errors(),
            ], 422);

        } catch (ModelNotFoundException $e) {
            return response()->json([
                'message' => 'Not Found',
            ], 404);
        }
    }

    public function show($blogId, $postId)
    {
        try{
            $blog = Blog::findOrFail($blogId);

            $post = Post::where('blog_id', $blogId)->with('likes', 'comments')->findOrFail($postId);
            return response()->json($post);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'message' => 'Not Found',
            ], 404);
        }
    }

    public function update(Request $request, $blogId, $postId)
    {
        try{
            $blog = Blog::findOrFail($blogId);

            $validated = $request->validate([
                'title' => 'nullable|string|max:255',
                'content' => 'nullable|string',
                'image_url' => 'nullable|url',
            ]);

            $post = Post::where('blog_id', $blogId)->findOrFail($postId);
            $post->update($validated);
            return response()->json($post);
        } catch (ValidationException $e) {
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $e->errors(),
            ], 422);

        } catch (ModelNotFoundException $e) {
            return response()->json([
                'message' => 'Not Found',
            ], 404);
        }
    }

    public function destroy($blogId, $postId)
    {
        try{
            $blog = Blog::findOrFail($blogId);

            $post = Post::where('blog_id', $blogId)->findOrFail($postId);
            $post->delete();
            return response()->json([
                'message' => 'Succesful',
            ], 204);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'message' => 'Not Found',
            ], 404);
        }
    }
}
