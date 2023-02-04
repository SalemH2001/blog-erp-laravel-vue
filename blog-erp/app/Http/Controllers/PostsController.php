<?php

namespace App\Http\Controllers;

use App\Models\Posts;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostsController extends Controller
{
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
