<?php

namespace App\Http\Controllers\admin;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::withTrashed()->orderBy('id', 'DESC')->get();
        return view('admin.category_index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.category_create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|unique:categories,title|max:255',
            'slug'  => 'nullable|unique:categories,slug|max:255',
        ]);

        Category::create([
            'title' => $request->title,
            'slug'  => $request->slug ?? Str::slug($request->title),
        ]);

        return redirect()->route('admin.category');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $category = Category::withTrashed()->findOrFail($id);
        return view('admin.category_edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'title' => 'required|max:255|unique:categories,title,' . $id,
            'slug'  => 'nullable|max:255|unique:categories,slug,' . $id,
        ]);

        $category = Category::withTrashed()->findOrFail($id);

        $category->title = $request->title;
        
        $category->slug = $request->slug ? $request->slug : \Illuminate\Support\Str::slug($request->title);
        $category->save();
        return redirect()->route('admin.category');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = Category::withTrashed()->findOrFail($id);
        if ($category->trashed()) {
            $category->restore();
            $message = 'Đã mở HIỆN lại danh mục: ' . $category->title;
        } else {
            $category->delete();
            $message = 'Đã ẨN danh mục: ' . $category->title;
        }

        return redirect()->route('admin.category');
    }
}
