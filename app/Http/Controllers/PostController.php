<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Requests\Posts\CreatePostRequest;
use App\Http\Requests\Posts\UpdatePostRequest;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller implements HasMiddleware
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        return view('posts.index', [
            'posts' => Post::searched()->paginate(3)->withQueryString(),
            'isTrash' => false,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        $tags = Tag::all();
        return view('posts.form', ['categories' => $categories, 'tags' => $tags]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreatePostRequest $request)
    {
        $validated = $request->validated();
        if($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('posts', 'public');
        }
        $post = Post::create($validated);
        $post->tags()->sync($validated['tags']); 
        return redirect()->route('posts.index')->with('success', 'Post created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        return view('posts.show', ['post' => $post]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        $categories = Category::all();
        $post->load('tags');
        $tags = Tag::all();
        return view('posts.form', ['post' => $post, 'categories' => $categories, 'tags' => $tags]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePostRequest $request, Post $post)
    {
        $validated = $request->validated();
        if($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('posts', 'public');
            if($post->image) {
                Storage::disk('public')->delete($post->image);
            }
        }
        $post->update($validated);
        $post->tags()->sync($validated['tags']);
        return redirect()->route('posts.index')->with('success', 'Post updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $post->delete();
        return redirect()->route('posts.index')->with('success', 'Post trashed successfully');
    }

    public function trash() {
        $posts = Post::onlyTrashed()->latest()->paginate(10);
        return view('posts.index', ['posts' => $posts, 'isTrash' => true]);
    }

    public function restore(Post $post) {
        $post->restore();
        return redirect()->back()->with('success', 'Post restored successfully');
    }

    public function forceDelete(Post $post) {
        if($post->image) {
            Storage::disk('public')->delete($post->image);
        }
        $post->forceDelete();
        return redirect()->route('posts.index')->with('success', 'Post deleted successfully');
    }

    public static function middleware(): array {
        return [
            new Middleware('has.categories', only: ['create', 'store'])
        ];
    }
}
