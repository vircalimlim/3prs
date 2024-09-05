<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::latest('id')->paginate(10);
        return Inertia::render('Admin/Category/Index', [
            'categories'    => $categories,
        ]);
    }

    public function storeCategory(Request $request){
        $request->validate([
            'title'         => 'required|unique:categories',
            'description'   => 'required'
        ]);

        Category::create([
            'title'         => $request->title,
            'description'   => $request->description,
        ]);
        return back();
    }

    public function updateCategory(Request $request)
    {
        $request->validate([
            'id'            => 'required',
            'title'         => 'required|unique:categories,title,'.$request->id,
            'description'   => 'required',
        ]);

        Category::where('id', $request->id)
            ->update([
                'title'         => $request->title,
                'description'   => $request->description,
            ]);
        return redirect()->back();
    }
}
