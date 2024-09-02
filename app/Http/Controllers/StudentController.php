<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Inertia\Inertia;

class StudentController extends Controller
{
    public function index(){
        $students = Student::latest('created_at')->paginate(10);
        return Inertia::render('Admin/Student/Index', [
            'students'  => $students
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
            'email'         => 'nullable|email:rfc,dns'
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
            'email'         => 'nullable|email:rfc,dns'
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
            ]);
        return redirect()->back();
    }
}
