<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class BlogController extends Controller
{
    //
    
    public function index()
    {
        $blogs = Blog::with('posts')->get();
        return response()->json($blogs);
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'title' => 'required|string|max:255',
                'description' => 'nullable|string',
                'image_url' => 'nullable|url',
            ]);
    
            $blog = Blog::create($validated);
    
            return response()->json($blog, 201);
    
        } catch (ValidationException $e) {
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $e->errors(),
            ], 422);
        }
    }

    public function show($id)
    {
        try{
            $blog = Blog::with('posts')->findOrFail($id);
            return response()->json($blog);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'message' => 'Blog not found',
            ], 404);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $validated = $request->validate([
                'title' => 'nullable|string|max:255',
                'description' => 'nullable|string',
                'image_url' => 'nullable|url',
            ]);
    
            $blog = Blog::findOrFail($id);
            $blog->update($validated);
    
            return response()->json($blog, 200);
    
        } catch (ValidationException $e) {
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $e->errors(),
            ], 422);
    
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'message' => 'Blog not found',
            ], 404);
        }
    }

    public function destroy($id)
    {
        try{
            $blog = Blog::findOrFail($id);
            $blog->delete();
            return response()->json(null, 204);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'message' => 'Blog not found',
            ], 404);
        }
    }
}
