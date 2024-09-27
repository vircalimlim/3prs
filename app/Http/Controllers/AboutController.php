<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class AboutController extends Controller
{

    private function saveImageToStorage($image){
        $filename   = time().'.'.$image->getClientOriginalExtension();
        $save_path = storage_path("app/public/images/about/");

        if (!file_exists($save_path)) {
            mkdir($save_path, 0775, true);
        }
        $image->move($save_path, $filename);
        return $filename;
    }

    public function index(){
        $about      = DB::table('abouts')->where('category', 'about')->first();
        $mission    = DB::table('abouts')->where('category', 'mission')->first();
        $vision     = DB::table('abouts')->where('category', 'vision')->first();
        $objectives = DB::table('abouts')->where('category', 'objectives')->first();
        return Inertia::render('About/About', [
            'about'         => $about,
            'mission'       => $mission,
            'vision'        => $vision,
            'objectives'    => $objectives,
        ]);
    }

    public function mission(){
        $mission    = DB::table('abouts')->where('category', 'mission')->first();
        return Inertia::render('About/Mission', [
            'mission'       => $mission,
        ]);
    }

    public function vision(){
        $vision     = DB::table('abouts')->where('category', 'vision')->first();
        return Inertia::render('About/Vision', [
            'vision'        => $vision,
        ]);
    }

    public function objective(){
        $objectives = DB::table('abouts')->where('category', 'objectives')->first();
        return Inertia::render('About/Objective', [
            'objectives'        => $objectives,
        ]);
    }

    public function update(Request $request) {
        $request->validate([
            'category'      => 'required',
            'description'   => 'required',
        ]);

        if($request->image){
            $image_name = $this->saveImageToStorage($request->file('image'));
            DB::table('abouts')
            ->where('category', $request->category)
            ->update([
                'description'   => $request->description,
                'thumbnail'     => $image_name,
            ]);
            return back();
        }


        DB::table('abouts')
        ->where('category', $request->category)
        ->update([
            'description'   => $request->description,
        ]);
        return back();
    }
}
