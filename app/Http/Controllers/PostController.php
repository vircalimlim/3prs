<?php

namespace App\Http\Controllers;

use App\Models\Achievement;
use App\Models\Announcement;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PostController extends Controller
{
    private function saveImageToStorage($type, $image){
        $filename = time().'.'.$image->getClientOriginalExtension();
        $save_path = storage_path("app/public/images/$type/");

        if (!file_exists($save_path)) {
            mkdir($save_path, 0775, true);
        }
        $image->move($save_path, $filename);
        return $filename;
    }

    public function index(){
        $result = [];
        $type = request()->type ? request()->type : 'achievements';
        if(request()->type == 'announcements'){
            $result = Announcement::paginate(10);
        }
        else{
            $result = Achievement::paginate(10);
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
            'description'   => 'required'
        ]);
        $image_name = $this->saveImageToStorage($request->type, $request->file('image'));
        if($request->type == 'achievements'){
            Achievement::create([
                'image'         => $image_name,
                'title'         => $request->title,
                'description'   => $request->description,
                'status'        => 'active',
            ]);
        }
        else if($request->type == 'announcements'){
            Announcement::create([
                'image'         => $image_name,
                'title'         => $request->title,
                'description'   => $request->description,
                'status'        => 'active',
            ]);
        }

        return back();
    }

    public function updatePost(Request $request){
        $request->validate([
            'id'            => 'required',
            'type'          => 'required',
            'title'         => 'required',
            'description'   => 'required'
        ]);

        if($request->type == 'achievements'){
            Achievement::where('id', $request->id)
            ->update([
                'title'         => $request->title,
                'description'   => $request->description
            ]);
        }
        else if($request->type == 'announcements'){
            Announcement::where('id', $request->id)
            ->update([
                'title'         => $request->title,
                'description'   => $request->description
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
        $image_name = $this->saveImageToStorage($request->type, $request->file('image'));
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
}
