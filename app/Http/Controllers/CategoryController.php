<?php

// في ملف CategoryController.php
namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Tag;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    use AuthorizesRequests;

    public function index()
    {
        $this->authorize('manageTag', Tag::class);

        $categories = Category::all();
        return view('categories.index', compact('categories'));
    }

    public function create()
    {
        $this->authorize('manageTag', Tag::class);

        return view('categories.create');
    }

    public function store(Request $request)
    {
        $this->authorize('manageTag', Tag::class);

        $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $category = new Category();
        $category->name = $request->name;

        if ($request->hasFile('image')) {
            $category->image = $request->file('image')->store('categories');
        }

        $category->save();

        return redirect()->route('categories.index')->with('success', 'Category created successfully!');
    }

    public function edit($id)
    {
        $this->authorize('manageTag', Tag::class);

        $category = Category::findOrFail($id);
        return view('categories.edit', compact('category'));
    }

    public function update(Request $request, $id)
    {
        $this->authorize('manageTag', Tag::class);

        $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $category = Category::findOrFail($id);
        $category->name = $request->name;

        if ($request->hasFile('image')) {
            // حذف الصورة القديمة
            if ($category->image) {
                Storage::delete($category->image);
            }
            $category->image = $request->file('image')->store('categories');
        }

        $category->save();

        return redirect()->route('categories.index')->with('success', 'Category updated successfully!');
    }

    public function destroy($id)

    {
        $this->authorize('manageTag', Tag::class);

        $category = Category::findOrFail($id);

        // حذف الصورة إذا كانت موجودة
        if ($category->image) {
            Storage::delete($category->image);
        }

        $category->delete();

        return redirect()->route('categories.index')->with('success', 'Category deleted successfully!');
    }
}

