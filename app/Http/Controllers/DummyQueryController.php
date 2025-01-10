<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DummyQueryController extends Controller
{
    // Retrieve "excerpt" and "description" columns
    public function retrieveData()
    {
        $posts = DB::table('posts')->select('excerpt', 'description')->get();
        return response()->json($posts); // Return as JSON
    }

    // Use distinct() to avoid duplicate values
    public function distinct()
    {
        $dist = DB::table('posts')->distinct()->get();
        return response()->json($dist);
    }

    // Retrieve the first record where "id" is 2
    public function wherePost2()
    {
        $id2 = DB::table('posts')->where('id', 2)->first();
        if ($id2) {
            return response()->json($id2);
        }
        return response()->json(['message' => 'Post not found'], 404);
    }

    // Retrieve only the "description" value where "id" is 2
    public function id2Des()
    {
        $des2 = DB::table('posts')->where('id', 2)->value('description');
        if ($des2) {
            return response()->json(['description' => $des2]);
        }
        return response()->json(['message' => 'Description not found'], 404);
    }

    // Retrieve the "title" column for all posts
    public function pluck()
    {
        $titles = DB::table('posts')->pluck('title');
        return response()->json($titles);
    }


    /**
     * Aggregate methods provide calculations on data:
     * - count(): Returns the number of rows.
     * - sum(): Returns the sum of a column.
     * - avg(): Returns the average value of a column.
     * - max(): Returns the maximum value of a column.
     * - min(): Returns the minimum value of a column.
     * Examples:
     *   DB::table('posts')->count();
     *   DB::table('posts')->sum('min_to_read');
     *   DB::table('posts')->avg('min_to_read');
     *   DB::table('posts')->max('min_to_read');
     *   DB::table('posts')->min('min_to_read');
     */

}
