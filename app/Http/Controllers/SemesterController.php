<?php

namespace App\Http\Controllers;

use App\Models\Semester;
use Illuminate\Http\Request;
use Inertia\Inertia;

class SemesterController extends Controller
{
    public function index(){
        $semesters = Semester::latest('id')->paginate(10);
        return Inertia::render('Admin/Semester/Index', [
            'semesters' => $semesters
        ]);
    }

    public function storeSemester(Request $request){
        $data = $request->validate([
            'name'          => 'required|unique:semesters',
            'start_date'    => 'required',
            'end_date'      => 'required'
        ]);

        Semester::create($data);
        return back();
    }

    public function updateSemester(Request $request)
    {
        $validated_data = $request->validate([
            'name'          => "required|unique:semesters,name,$request->id",
            'start_date'    => 'required',
            'end_date'      => 'required',
            'id'            => 'required'
        ]);

        $semester = Semester::where('id', $request->id)
            ->update([
                'name'          => $request->name,
                'start_date'    => $request->start_date,
                'end_date'      => $request->end_date,
            ]);
        return redirect()->back();
    }
}
