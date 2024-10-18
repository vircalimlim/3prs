<?php

namespace App\Http\Controllers;

use App\Models\Futurism;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Inertia\Inertia;

class FuturismController extends Controller
{
    private function saveImageToStorage($image, $index = 0){
        $filename = $index . time().'.'.$image->getClientOriginalExtension();
        $save_path = storage_path("app/public/images/futurism/");

        if (!file_exists($save_path)) {
            mkdir($save_path, 0775, true);
        }
        $image->move($save_path, $filename);
        return $filename;
    }

    private function uploadImages($image_files, $post_id){
        if($image_files){
            foreach($image_files as $index => $image_file){

                // Validate if the file is an image
                $validator = Validator::make(['image' => $image_file], [
                    'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:10240'
                ]);

                if ($validator->fails()) {
                    continue;
                }

                $image_name_2 = $this->saveImageToStorage($image_file, $index);
                DB::table('futurism_images')->insert([
                    'post_id'   => $post_id,
                    'file_name' => $image_name_2
                ]);
            }
        }
    }

    public function index(){
        $result = [];
        $category = !empty(request()->category) ? request()->category : '';
        if($category){
            $result = Futurism::with('images')->where('status', 'active')->latest('created_at')->where('category', $category)->paginate(10);
        }
        else{
            $result = Futurism::with('images')->where('status', 'active')->latest('created_at')->paginate(10);
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
        $image_name = $this->saveImageToStorage($request->file('image'), '1999');
        $futurism = Futurism::create([
            'category'      => $request->category,
            'image'         => $image_name,
            'title'         => $request->title,
            'description'   => $request->description,
            'status'        => 'active',
        ]);
        $this->uploadImages($request->file('images'), $futurism->id);

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
        $image_name = $this->saveImageToStorage($request->file('image'), '1999');
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
        $futurism = Futurism::with('images')->find($request->id);
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

    public function deleteFuturismImage(Request $request){
        $request->validate([
            'id'            => 'required',
        ]);

        DB::table('futurism_images')->where('id', $request->id)->delete();

        $path = 'public/images/futurism/' . $request->image_name;
        if (Storage::disk('local')->exists($path)) {
            Storage::delete($path);
        }

        return back();
    }

    public function uploadFuturismImages(Request $request){
        $request->validate([
            'id'          => 'required'
        ]);

        $this->uploadImages($request->file('images'), $request->id);
        return back();
    }
}
