<?php

namespace App\Http\Controllers;

use App\Models\Achievement;
use App\Models\Announcement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

class GeneralController extends Controller
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
    
    public function index() {
        return Inertia::render('Welcome', [
            'canLogin'      => Route::has('login'),
            'canRegister'   => Route::has('register'),
            'achievements'  => Achievement::where('status', 'active')->latest('created_at')->take(3)->get(),
            'announcements' => Announcement::where('status', 'active')->latest('created_at')->take(3)->get(),
            'section1'      => DB::table('sections')->where('category', 'section1')->first(),
            'section2'      => DB::table('sections')->where('category', 'section2')->first(),
            'storage_link'  => asset('storage/images/'),
        ]);
    }

    public function updateSection(Request $request) {
        if($request->category == 'section1'){
            if($request->image){
                $image_name = $this->saveImageToStorage($request->file('image'));
                DB::table('sections')
                ->where('category', $request->category)
                ->update([
                    'thumbnail'     => $image_name,
                ]);
            }
            return back();
        }


        $request->validate([
            'category'      => 'required',
            'description'   => 'required',
        ]);

        if($request->image){
            $image_name = $this->saveImageToStorage($request->file('image'));
            DB::table('sections')
            ->where('category', $request->category)
            ->update([
                'description'   => $request->description,
                'thumbnail'     => $image_name,
            ]);
            return back();
        }


        DB::table('sections')
        ->where('category', $request->category)
        ->update([
            'description'   => $request->description,
        ]);
        return back();
    }

    public function updatePassword(){
        return Inertia::render('Profile/Partials/UpdatePasswordForm');
    }

    public function updateContact(Request $request){
        $request->validate([
            'fb_name'   => 'required',
            'fb_link'   => 'required',
            'email'     => 'required',
        ]);

        DB::table('contact')
        ->update([
            'fb_name'   => $request->fb_name,
            'fb_link'   => $request->fb_link,
            'email'     => $request->email,
        ]);
        return back();
    }
}
