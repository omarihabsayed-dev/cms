<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tag;
use App\Http\Requests\Tags\CreateTagRequest;
use App\Http\Requests\Tags\UpdateTagRequest;

class TagController extends Controller
{
        /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('tags.index', ['tags' => Tag::all()]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('tags.form');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateTagRequest $request)
    {
        $validated = $request->validated();
        Tag::create($validated);
        return redirect()->route('tags.index')->with('success', 'Tag added successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Tag $tag)
    {
        $posts = $tag->posts()->searched()->latest()->paginate(10)->withQueryString();
        return view('posts.index', ['posts' => $posts, 'tag' => $tag, 'isTrash' => false]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tag $tag)
    {
        return view('tags.form', ['tag' => $tag]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTagRequest $request, Tag $tag)
    {
        $validated = $request->validated();
        $tag->update($validated);
        return redirect()->route('tags.index')->with('success', 'Tag updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tag $tag)
    {
        if($tag->posts->count() > 0) {
            return redirect()->back()->with('error', 'Tag can not be deleted because it is linked to a post.');
        }
        $tag->delete();
        return redirect()->route('tags.index')->with('success', 'Tag deleted successfully');
    }
}
