<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Semester extends Model
{
    use HasFactory;
    protected $guarded = [];
    public $timestamps = false;

    public static function getEnrolledStudents($sem = ''){
        $students = DB::table('semester_student as ss')
                    ->selectRaw('sem.name, st.first_name, st.last_name, st.gender, st.dob, users.user_key')
                    ->leftJoin('semesters as sem', 'ss.semester_id', '=', 'sem.id')
                    ->leftJoin('students as st', 'ss.student_id', '=', 'st.id')
                    ->leftJoin('users', 'ss.semester_id', '=', 'users.semester_id');

        if(!empty($sem)){
            $students = $students->where('ss.semester_id', $sem);
        }

        $students = $students->latest('sem.start_date')->paginate(20);
        return $students;
    }
}
