<?php

namespace App\Http\Controllers;

use App\Models\Posts;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

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

    public function index(Request $request)
    {
        $query = Posts::with('user', 'categories');
    
        if ($request->category) {
            $query->whereHas('categories', function ($query) use ($request) {
                $query->where('name', $request->category);
            });
        }
    
        if ($request->search) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }
    
        return $query->latest()->paginate(4);
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

    public function update(Request $request,$slug)
    {
        $post=Posts::where('slug',$slug)->first();
        if (auth()->user()->id !== $post->user->id) {
            return abort(403);
        }
        $request->validate([
            'title' => 'required',
            'file' => 'nullable | image',
            'body' => 'required',
            'category_id' => 'required'
        ]);

        $title = $request->title;
        $category_id = $request->category_id;


        $slug = Str::slug($title, '-') . '-' . $post->id;
        $body = $request->input('body');

        if ($request->file('file')) {
            $imagePath = 'storage/' . $request->file('file')->store('postsImages', 'public');
            $post->imagePath = $imagePath;
        }

        // create and save post
        $post->title = $title;
        $post->category_id = $category_id;
        $post->slug = $slug;
        $post->body = $body;
        return $post->save();
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
