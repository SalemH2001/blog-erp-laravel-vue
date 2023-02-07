<?php

namespace App\Http\Controllers;

use App\Models\Posts;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostsController extends Controller
{

    public function homeindex()
    {
        return Posts::with('user')->take(4)->get();
    }

    public function relatedPosts($slug)
    {
        $post = Posts::where('slug', $slug)->first();

        if ($post) {
            $category = $post->categories;
            if ($category) {
                $relatedPosts = $category->posts()->where('id', '!=', $post->id)->take(4)->get();
                return $relatedPosts;
            }
        }

        return [];
    }

    public function dashboardPosts(){
        return Posts::where('user_id', auth()->user()->id)->latest()->get();
    }

    public function index()
    {
        return Posts::with('user','categories')->paginate(4);
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

    function edit(Request $request,$slug){
        $request->validate([
            'title' => ['string', 'required', 'max:100'],
            'file' => ['image'],
            'body' => ['required', 'string'],
            'category_id' => ['required','integer'],

        ]);
        $post = Posts::where('slug', $slug)->first();
        $categories_id = $request->input('category_id');
        $body = $request->input('body');
        if($request->input('file')){
            $imagePath = 'storage/' . $request->file('file')->store('postsImage', 'public');
        }else $imagePath= $post->ImagePath;
        $post->title = $request->input('title');
        $post->category_id = $categories_id;
        $post->body = htmlentities($body);
        $post->ImagePath = $imagePath;
        $post->save();

    }
    
    public function destroy($slug)
    {
        $post=Posts::where('slug',$slug)->first();
        if ($post->delete()) {
            return response()->json(null, 204);
        } else {
            return response()->json(['error' => 'Bad Request'], 400);
        }
    }
}
