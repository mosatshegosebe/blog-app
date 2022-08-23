<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function create()
    {
        $categories = Category::all();
        return view('category.create', compact('categories'));
    }

    public function store(Request $request, Category $category)
    {
       $request->validate([
            'category_name' => 'required|max:255',
        ]);

       $category->category_name = $request->category_name;
       $category->save();
       flash('Category created')->success();

       return back();
    }
}
