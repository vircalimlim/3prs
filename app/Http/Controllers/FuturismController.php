<?php

namespace App\Http\Controllers;

use App\Models\Futurism;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class FuturismController extends Controller
{
    private function saveImageToStorage($image){
        $filename = time().'.'.$image->getClientOriginalExtension();
        $save_path = storage_path("app/public/images/futurism/");

        if (!file_exists($save_path)) {
            mkdir($save_path, 0775, true);
        }
        $image->move($save_path, $filename);
        return $filename;
    }

    public function index(){
        $result = [];
        $category = !empty(request()->category) ? request()->category : '';
        if($category){
            $result = Futurism::where('status', 'active')->latest('created_at')->where('category', $category)->paginate(10);
        }
        else{
            $result = Futurism::where('status', 'active')->latest('created_at')->paginate(10);
        }

        $storage_link = asset('storage/images/futurism');

        return Inertia::render('Admin/Futurism/Index', [
            'posts' => $result,
            'storage_link'  => $storage_link
        ]);
    }

    public function storePost(Request $request){
        $request->validate([
            'category'      => 'required',
            'title'         => 'required',
            'image'         => 'required|mimes:jpeg,png,jpg,gif|max:10240', //max 10mb
            'description'   => 'required'
        ]);
        $image_name = $this->saveImageToStorage($request->file('image'));
        Futurism::create([
            'category'      => $request->category,
            'image'         => $image_name,
            'title'         => $request->title,
            'description'   => $request->description,
            'status'        => 'active',
        ]);

        return back();
    }

    public function updatePost(Request $request){
        $request->validate([
            'id'            => 'required',
            'title'         => 'required',
            'description'   => 'required'
        ]);

        Futurism::where('id', $request->id)
        ->update([
            'title'         => $request->title,
            'description'   => $request->description
        ]);

        return back();
    }

    public function handleImageUpdate(Request $request){
        $request->validate([
            'id'            => 'required',
            'image'         => 'required|mimes:jpeg,png,jpg,gif|max:10240', //max 10mb
        ]);
        $image_name = $this->saveImageToStorage($request->file('image'));
        Futurism::where('id', $request->id)
        ->update([
            'image'         => $image_name,
        ]);

        return back();
    }

    public function indexPublic(Request $request)
    {
        $fullNamecategoryList = ['Av Innovation', 'Futurism', 'Social Impact', 'Women Empowerment', 'Learning Development', 'Environmental Projects', 'Student Initiatives'];

        $category = $request->category;
        $futurisms = DB::table('futurisms')
            ->where('status', 'active')
            ->where('category', $category)
            ->get();
            
        $storage_link = asset('storage/images/futurism/');
        $fullNameCategory = array_filter($fullNamecategoryList, function($string) use ($category) {
            return stripos($string, $category) !== false;
        });
        $fullNameCategory = reset($fullNameCategory);
        if(!$fullNameCategory) abort(404);

        return Inertia::render('Futurism/Index', [
            'futurisms'     => $futurisms,
            'storage_link'  => $storage_link,
            'category'      => $fullNameCategory,
        ]);
    }

    public function getSingleFuturism(Request $request)
    {
        $futurism = Futurism::find($request->id);
        $more_futurisms = Futurism::where('id', '!=', $request->id)->where('status', 'active')->latest('created_at')->take(10)->get();
        $storage_link = asset('storage/images/futurism');
        return Inertia::render('Futurism/Id', [
            'futurism'          => $futurism,
            'more_futurisms'    => $more_futurisms,
            'storage_link'      => $storage_link,
        ]);
    }

    public function deleteFuturism(Request $request){
        $request->validate([
            'id'            => 'required'
        ]);

        Futurism::where('id', $request->id)
        ->update([
            'status'         => 'inactive'
        ]);

        return back();
    }
}
