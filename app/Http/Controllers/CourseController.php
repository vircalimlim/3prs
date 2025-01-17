<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function storeCourse(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:courses'
        ]);

        Course::create([
            'name' => $request->name
        ]);

        return back();
    }

}
