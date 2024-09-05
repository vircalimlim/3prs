<?php

namespace App\Http\Controllers;

use App\Models\Semester;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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

    public function registerStudentIndex(){
        $students   = Student::latest('id')->paginate(20);
        $semesters  = Semester::latest('id')->get();
        return Inertia::render('Admin/Semester/RegisterStudent', [
            'students' => $students,
            'semesters' => $semesters,
        ]);
    }

    public function registerStudent(Request $request){
        $data = $request->validate([
            'selected_sem'          => 'required',
            'selected_students'     => 'required'
        ]);

        foreach($request->selected_students as $student){
            $is_exist = DB::table('semester_student')
                        ->where('student_id', $student)
                        ->where('semester_id', $request->selected_sem)
                        ->exists();
            if($is_exist) continue; //skip this current iteration proceed to next

            DB::table('semester_student')
            ->insert([
                'semester_id'   => $request->selected_sem,
                'student_id'    => $student,
            ]);
        }

        return back();
    }

    public function enrolledStudentIndex(Request $request){
        $students = Semester::getEnrolledStudents($request->sem);
        $semesters  = Semester::latest('id')->get();
        return Inertia::render('Admin/Semester/EnrolledStudent', [
            'students'  => $students,
            'semesters' => $semesters,
        ]);
    }
}
