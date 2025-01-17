<?php

namespace App\Http\Controllers;

use App\Models\Semester;
use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Inertia\Inertia;

class SemesterController extends Controller
{
    private function generateUserKey() {
        $number = mt_rand(1000000000, 9999999999);
    
        // call the same function if the barcode exists already
        if ($this->isUserKeyExist($number)) {
            return $this->generateUserKey();
        }
    
        // otherwise, it's valid and can be used
        return $number;
    }
    
    private function isUserKeyExist($number) {
        return User::where('user_key', $number)->exists();
    }

    public function index(){
        $semesters = Semester::latest('id')->paginate(10);
        return Inertia::render('Admin/Semester/Index', [
            'semesters' => $semesters
        ]);
    }

    public function storeSemester(Request $request){
        $data = $request->validate([
            'name'          => 'required|unique:semesters',
            'start_date'    => 'required|unique:semesters',
            'end_date'      => 'required|unique:semesters'
        ]);

        Semester::create($data);
        return back();
    }

    public function updateSemester(Request $request)
    {
        $validated_data = $request->validate([
            'name'          => "required|unique:semesters,name,$request->id",
            'start_date'    => "required|unique:semesters,start_date,$request->id",
            'end_date'      => "required|unique:semesters,end_date,$request->id",
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

    public function createAccountForEnrolledStudent($student_id, $semester_id, $password){
        $user_key = $this->generateUserKey();
        $student = Student::find($student_id);
        $user = User::create([
            'student_id' => $student_id,
            'semester_id' => $semester_id,
            'user_key' => $user_key,
            'name' => $student->first_name . ' ' . $student->last_name,
            'email' => $student->email,
            'password' => Hash::make($password),
        ]);
    }

    public function registerStudent(Request $request){
        $data = $request->validate([
            'selected_sem'          => 'required',
            'selected_students'     => 'required'
        ]);
        $selected_students = [];

        if($request->select_all){
            $students = Student::get();
            $ids = $students->pluck('id')->toArray();
            $selected_students = $ids;
        }
        else{
            $selected_students = $request->selected_students;
        }


        foreach($selected_students as $student){
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

            $this->createAccountForEnrolledStudent($student, $request->selected_sem, 'pass@student');
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
