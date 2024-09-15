<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Material;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class MaterialController extends Controller
{
    private function saveFileToStorage($file_pdf)
    {
        $filename = time() . '.' . $file_pdf->getClientOriginalExtension();
        $save_path = storage_path("app/public/materials/");

        if (!file_exists($save_path)) {
            mkdir($save_path, 0775, true);
        }
        $file_pdf->move($save_path, $filename);
        return $filename;
    }

    private function userVisit($user_id, $origin)
    {
        if ($user_id) {
            DB::table('user_visit')
                ->insert(['user_id' => $user_id, 'origin' => $origin, 'created_at' => date('Y-m-d H:i:s')]);
        }
    }

    public function index(Request $request)
    {
        $materials = Material::with('category');

        if (!empty($request->type)) {
            $materials = $materials->where('category_id', $request->type);
        }

        $materials = $materials->latest('id')->paginate(10);
        $categories = Category::latest('id')->get();
        $file_link = asset('storage/materials/');
        return Inertia::render('Admin/Material/Index', [
            'materials'     => $materials,
            'categories'    => $categories,
            'file_link'     => $file_link,
        ]);
    }

    public function storeMaterial(Request $request)
    {
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

    public function updateMaterial(Request $request)
    {
        $request->validate([
            'id'            => 'required',
            'category'      => 'required',
            'title'         => 'required|unique:materials,title,' . $request->id,
            'description'   => 'required',
            'pdf'           => 'nullable|mimetypes:application/pdf',
        ]);

        $file_name = '';
        if (empty($request->pdf)) {
            $file_name = $request->currentFile;
        } else {
            $file_name = $this->saveFileToStorage($request->file('pdf'));
        }

        Material::where('id', $request->id)
            ->update([
                'category_id'      => $request->category,
                'title'         => $request->title,
                'description'   => $request->description,
                'file_path'     => $file_name,
            ]);

        return back();
    }

    public function indexPublic(Request $request)
    {
        $search = $request->search;
        $search = str_replace('-', ' ', $search);
        $materials = DB::table('materials as m')
            ->selectRaw('m.*, c.title as category_name')
            ->leftJoin('categories as c', 'm.category_id', '=', 'c.id')
            ->where(function ($query) use ($search) {
                $query->where('m.title', 'like', '%' . $search . '%')
                    ->orWhere('c.title', 'like', '%' . $search . '%');
            })
            ->latest('created_at')
            ->get();
        $storage_link = asset('storage/materials/');
        return Inertia::render('Material/Index', [
            'materials' => $materials,
            'storage_link'  => $storage_link,
        ]);
    }

    public function getSingleMaterial(Request $request)
    {
        $material = Material::find($request->id);
        if (!$material) abort(404);

        $user_id = auth()->user()->student_id;
        $this->userVisit($user_id, 'research');

        $file = asset('storage/materials') . '/' . $material->file_path;
        return Inertia::render('Material/Id', [
            'pdfSource' => $file
        ]);
    }
}
