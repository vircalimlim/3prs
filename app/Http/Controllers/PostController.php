<?php

namespace App\Http\Controllers;

use App\Models\Achievement;
use App\Models\Announcement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    private function saveImageToStorage($type, $image, $index = 0){
        $filename = $index . time() . '.' . $image->getClientOriginalExtension();
        $save_path = storage_path("app/public/images/$type/");

        if (!file_exists($save_path)) {
            mkdir($save_path, 0775, true);
        }
        $image->move($save_path, $filename);
        return $filename;
    }

    private function uploadImages($image_files, $category, $post_id){
        if($image_files){
            foreach($image_files as $index => $image_file){

                // Validate if the file is an image
                $validator = Validator::make(['image' => $image_file], [
                    'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:10240'
                ]);

                if ($validator->fails()) {
                    continue;
                }

                $image_name_2 = $this->saveImageToStorage($category, $image_file, $index);
                DB::table('post_images')->insert([
                    'category'  => $category,
                    'post_id'   => $post_id,
                    'file_name' => $image_name_2
                ]);
            }
        }
    }

    public function index(){
        $result = [];
        $type = request()->type ? request()->type : 'achievements';
        if(request()->type == 'announcements'){
            $result = Announcement::with('images')->where('status', 'active')->latest('publish_date')->paginate(10);
        }
        else{
            $result = Achievement::with('images')->where('status', 'active')->latest('publish_date')->paginate(10);
        }
        $storage_link = asset('storage/images/'.$type);

        return Inertia::render('Admin/Post/Index', [
            'posts' => $result,
            'storage_link'  => $storage_link
        ]);
    }

    public function storePost(Request $request){
        $request->validate([
            'type'          => 'required',
            'title'         => 'required',
            'image'         => 'required|mimes:jpeg,png,jpg,gif|max:10240', //max 10mb
            'description'   => 'required',
            'publish_date'  => 'required|date'
        ]);
        $image_name = $this->saveImageToStorage($request->type, $request->file('image'), '1999');
        if($request->type == 'achievements'){
            $achievement = Achievement::create([
                'image'         => $image_name,
                'title'         => $request->title,
                'description'   => $request->description,
                'status'        => 'active',
                'publish_date'  => $request->publish_date,
            ]);

            $this->uploadImages($request->file('images'), $request->type, $achievement->id);
        }
        else if($request->type == 'announcements'){
            $announcement = Announcement::create([
                'image'         => $image_name,
                'title'         => $request->title,
                'description'   => $request->description,
                'status'        => 'active',
                'publish_date'  => $request->publish_date,
            ]);

            $this->uploadImages($request->file('images'), $request->type, $announcement->id);
        }

        return back();
    }

    public function updatePost(Request $request){
        $request->validate([
            'id'            => 'required',
            'type'          => 'required',
            'title'         => 'required',
            'description'   => 'required',
            'publish_date'  => 'required|date'
        ]);

        if($request->type == 'achievements'){
            Achievement::where('id', $request->id)
            ->update([
                'title'         => $request->title,
                'description'   => $request->description,
                'publish_date'  => $request->publish_date
            ]);
        }
        else if($request->type == 'announcements'){
            Announcement::where('id', $request->id)
            ->update([
                'title'         => $request->title,
                'description'   => $request->description,
                'publish_date'  => $request->publish_date
            ]);
        }

        return back();
    }

    public function handleImageUpdate(Request $request){
        $request->validate([
            'id'            => 'required',
            'type'          => 'required',
            'image'         => 'required|mimes:jpeg,png,jpg,gif|max:10240', //max 10mb
        ]);
        $image_name = $this->saveImageToStorage($request->type, $request->file('image'), '1999');
        if($request->type == 'achievements'){
            Achievement::where('id', $request->id)
            ->update([
                'image'         => $image_name,
            ]);
        }
        else if($request->type == 'announcements'){
            Announcement::where('id', $request->id)
            ->update([
                'image'         => $image_name,
            ]);
        }

        return back();
    }

    public function deletePost(Request $request){
        $request->validate([
            'id'            => 'required',
            'type'          => 'required',
        ]);

        if($request->type == 'achievements'){
            Achievement::where('id', $request->id)
            ->update([
                'status'         => 'inactive'
            ]);
        }
        else if($request->type == 'announcements'){
            Announcement::where('id', $request->id)
            ->update([
                'status'         => 'inactive'
            ]);
        }

        return back();
    }

    public function deletePostImage(Request $request){
        $request->validate([
            'id'            => 'required',
        ]);

        DB::table('post_images')->where('id', $request->id)->delete();

        $path = 'public/images/' . $request->type . '/' . $request->image_name;
        if (Storage::disk('local')->exists($path)) {
            Storage::delete($path);
        }

        return back();
    }

    public function uploadPostImages(Request $request){
        $request->validate([
            'id'          => 'required',
            'type'        => 'required'
        ]);

        $this->uploadImages($request->file('images'), $request->type, $request->id);

        return back();
    }

}
