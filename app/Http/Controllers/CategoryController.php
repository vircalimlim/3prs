<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Material;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::where('status', 'active')
            ->latest('id')
            ->paginate(10);
        return Inertia::render('Admin/Category/Index', [
            'categories' => $categories,
        ]);
    }

    public function storeCategory(Request $request)
    {
        $request->validate([
            'title' => 'required|unique:categories',
            'description' => 'required'
        ]);

        Category::create([
            'title' => $request->title,
            'description' => $request->description,
        ]);
        return back();
    }

    public function updateCategory(Request $request)
    {
        $request->validate([
            'id' => 'required',
            'title' => 'required|unique:categories,title,'.$request->id,
            'description' => 'required',
        ]);

        Category::where('id', $request->id)
            ->update([
                'title' => $request->title,
                'description' => $request->description,
            ]);
        return redirect()->back();
    }

    public function deleteCategory(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:categories,id',
        ]);

        Category::where('id', $request->id)
            ->update([
                'status' => 'inactive',
            ]);
        Material::where('category_id', $request->id)->update(['status' => 'inactive']);
        
        return redirect()->back();
    }
}
