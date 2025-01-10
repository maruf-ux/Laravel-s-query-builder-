<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CrudController extends Controller
{
    // Fetch all posts
    public function index()
    {
        $posts = DB::table('posts')->get();
        return response()->json($posts); // Return posts as JSON
    }

    // Show a single post by ID
    public function show(string $id)
    {
        $post = DB::table('posts')->find($id);
        if ($post) {
            return response()->json($post); // Return the post as JSON
        }
        return response()->json(['message' => 'Post not found'], 404);
    }

    // Store a new post
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:posts',
            'excerpt' => 'nullable|string',
            'description' => 'nullable|string',
            'is_published' => 'boolean',
            'min_to_read' => 'integer|min:1',
        ]);

        $result = DB::table('posts')->insert($validated);

        if ($result) {
            return response()->json(['message' => 'Post created successfully'], 201);
        }
        return response()->json(['message' => 'Failed to create post'], 500);
    }

    // Update an existing post
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'excerpt' => 'nullable|string',
            'description' => 'nullable|string',
        ]);

        $affectedRows = DB::table('posts')->where('id', $id)->update($validated);

        if ($affectedRows) {
            return response()->json(['message' => 'Post updated successfully']);
        }
        return response()->json(['message' => 'Failed to update post'], 404);
    }

    // Delete a post
    public function destroy(string $id)
    {
        $deletedRows = DB::table('posts')->where('id', $id)->delete();

        if ($deletedRows) {
            return response()->json(['message' => 'Post deleted successfully']);
        }
        return response()->json(['message' => 'Post not found'], 404);
    }
}
