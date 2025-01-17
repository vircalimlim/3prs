<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Semester;
use App\Models\Student;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Hash;

class StudentController extends Controller
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

    public function index(Request $request){
        if(!$request->sem) abort(404);
        $semester       = Semester::findOrFail($request->sem);

        $students   = Student::where('status', 'active')->latest('created_at')->paginate(10);
        foreach($students as $student){
            $enrolled = DB::table('semester_student')->where('student_id', $student->id)->where('semester_id', $semester->id)->exists();
            $student->is_enrolled = $enrolled;
            $course = Course::where('id', $student->course_id)->first();
            $student->course = $course ? $course->name : '';
            $student->user_key = '';
            if($enrolled){
                $student->user_key = User::where('student_id', $student->id)->where('semester_id', $semester->id)->first()->user_key;
            }
        }
        $courses    = Course::latest('id')->orderBy('name', 'asc')->get();
        return Inertia::render('Admin/Student/Index', [
            'students'  => $students,
            'courses'   => $courses,
        ]);
    }

    public function storeStudent(Request $request){
        $request->validate([
            'first_name'    => 'required',
            'middle_name'   => 'required',
            'last_name'     => 'required',
            'address'       => 'required',
            'dob'           => 'required',
            'gender'        => 'required',
            'mobile'        => 'nullable|digits:11',
            'email'         => 'required|email:rfc,dns|unique:students',
            'student_number'=> 'required|unique:students',
            'course_id'     => 'required'
        ]);
        $email = $request->email ? $request->email : '';
        $mobile = $request->mobile ? $request->mobile : '';

        Student::create([
            'first_name'    => $request->first_name,
            'middle_name'   => $request->middle_name,
            'last_name'     => $request->last_name,
            'address'       => $request->address,
            'dob'           => $request->dob,
            'gender'        => $request->gender,
            'email'         => $email,
            'mobile'        => $mobile,
            'student_number'=> $request->student_number,
            'course_id'     => $request->course_id,
        ]);
        return back();
    }

    public function updateStudent(Request $request)
    {
        $request->validate([
            'first_name'    => 'required',
            'middle_name'   => 'required',
            'last_name'     => 'required',
            'address'       => 'required',
            'dob'           => 'required',
            'gender'        => 'required',
            'mobile'        => 'nullable|digits:11',
            'email'         => 'required|email:rfc,dns|unique:students,email,'.$request->id,
            'student_number'=> 'required|unique:students,student_number,'.$request->id,
            'course_id'     => 'required'
        ]);
        $email = $request->email ? $request->email : '';
        $mobile = $request->mobile ? $request->mobile : '';

        $student = Student::where('id', $request->id)
            ->update([
                'first_name'    => $request->first_name,
                'middle_name'   => $request->middle_name,
                'last_name'     => $request->last_name,
                'address'       => $request->address,
                'dob'           => $request->dob,
                'gender'        => $request->gender,
                'email'         => $email,
                'mobile'        => $mobile,
                'student_number'=> $request->student_number,
                'course_id'     => $request->course_id,
            ]);
        User::where('student_id', $request->id)->update(['email' => $email]);
        return redirect()->back();
    }

    public function deleteStudent(Request $request)
    {
        $id = $request->id;
        $student = Student::findOrFail($id);
        User::where('email', $student->email)->delete();
        DB::table('semester_student')->where('student_id', $student->id)->delete();
        $student->delete();

        return redirect()->back()->with('success', 'Student deleted successfully.');
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

    public function enrollStudent(Request $request){
        $data = $request->validate([
            'toEnrollStudents' => 'required',
        ]);

        foreach($request->toEnrollStudents as $toEnrollStudent){
            $student = Student::find($toEnrollStudent['student_id']);

            DB::table('semester_student')
            ->insert([
                'semester_id'   => $toEnrollStudent['sem_id'],
                'student_id'    => $toEnrollStudent['student_id'],
            ]);

            $this->createAccountForEnrolledStudent($toEnrollStudent['student_id'], $toEnrollStudent['sem_id'], $student->student_number ? $student->student_number : 'pass@dev');
        }

        return back();
    }
}
