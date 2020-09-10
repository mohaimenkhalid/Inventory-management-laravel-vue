<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index()
    {
        $category = Category::all();
        return response()->json($category);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => ['required', 'string', 'max:255'],
        ]);

        $category = new Category;
        $category->name = $request->name;
        $category->save();
        return response()->json(['success' => 'Category added successfully!']);
    }

    public function destroy($id) {
        $category = Category::find($id)->delete();
        return response()->json(['success', 'Category deleted successfully!']);
    }

    public function update($id, Request $request){
        $category = Category::find($id);
        $category->name = $request->name;
        $category->save();
        return response()->json(['success' => 'Category updated successfully!']);
    }
}
