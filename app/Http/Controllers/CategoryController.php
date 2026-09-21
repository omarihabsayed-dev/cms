<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Requests\Categories\CreateCategoryRequest;
use App\Http\Requests\Categories\UpdateCategoryRequest;


class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('categories.index', ['categories' => Category::all()]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('categories.form');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateCategoryRequest $request)
    {
        $validated = $request->validated();
        Category::create($validated);
        return redirect()->route('categories.index')->with('success', 'Category added successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        $posts = $category->posts()->searched()->latest()->paginate(10)->withQueryString();
        return view('posts.index', ['posts' => $posts, 'category' => $category, 'isTrash' => false]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        return view('categories.form', ['category' => $category]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoryRequest $request, Category $category)
    {
        $validated = $request->validated();
        $category->update($validated);
        return redirect()->route('categories.index')->with('success', 'Category updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        if($category->posts->count() > 0) {
            return redirect()->back()->with('error', 'Category can not be deleted because it is linked to a post.');
        }
        $category->delete();
        return redirect()->route('categories.index')->with('success', 'Category deleted successfully');
    }
}
