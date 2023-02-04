<?php

namespace App\Http\Controllers;

use App\Models\Posts;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostsController extends Controller
{

    public function index()
    {
        return Posts::with('user')->take(4)->get();
    }
    
    public function show($slug)
    {
        $post = Posts::with('user')->where('slug', $slug)->first();
        if (!$post) {
            return response()->json(['error' => 'Post not found'], 404);
        }
        $post->body = html_entity_decode($post->body);

        return $post;
    }


    public function store(Request $request)
    {
        $request->validate([
            'title' => ['string', 'required', 'max:100', 'unique:posts'],
            'file' => ['required', 'image'],
            'body' => ['required', 'string'],
            'category_id' => ['required','integer'],

        ]);
    
        $user_id = Auth::id();
        $categories_id = $request->input('category_id');
        $body = $request->input('body');
        $imagePath = 'storage/' . $request->file('file')->store('postsImage', 'public');
    
        $post = new Posts([
            'title' => $request->title,
            'category_id' => $categories_id,
            'user_id' => $user_id,
            'body' => htmlentities($body),
            'ImagePath' => $imagePath
        ]);
    
        $post->save();
    }
    
}
