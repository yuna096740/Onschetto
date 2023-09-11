<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class PostController extends Controller
{
    public function index(Request $request) {
        if ($request->ajax()) {
            $data = DB::table('posts')->select('user_id', 'task', 'details', 'schedule')->get();
            return response()->json($data);
        }
        return view('posts.index');
    }
}
