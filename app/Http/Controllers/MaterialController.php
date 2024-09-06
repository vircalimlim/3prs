<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Material;
use Illuminate\Http\Request;
use Inertia\Inertia;

class MaterialController extends Controller
{
    private function saveFileToStorage($file_pdf){
        $filename = time().'.'.$file_pdf->getClientOriginalExtension();
        $save_path = storage_path("app/public/materials/");

        if (!file_exists($save_path)) {
            mkdir($save_path, 0775, true);
        }
        $file_pdf->move($save_path, $filename);
        return $filename;
    }

    public function index()
    {
        $materials = Material::with('category')->latest('id')->paginate(10);
        $categories = Category::latest('id')->get();
        $file_link = asset('storage/materials/');
        return Inertia::render('Admin/Material/Index', [
            'materials'     => $materials,
            'categories'    => $categories,
            'file_link'     => $file_link,
        ]);
    }

    public function storeMaterial(Request $request){
        $request->validate([
            'category'      => 'required',
            'title'         => 'required|unique:materials',
            'description'   => 'required',
            'pdf'           => 'required|mimetypes:application/pdf',
        ]);

        $file_name = $this->saveFileToStorage($request->file('pdf'));
        Material::create([
            'category_id'   => $request->category,
            'title'         => $request->title,
            'description'   => $request->description,
            'file_path'     => $file_name,
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
