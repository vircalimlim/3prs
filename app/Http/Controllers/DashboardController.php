<?php

namespace App\Http\Controllers;

use App\Models\Achievement;
use App\Models\Announcement;
use App\Models\Material;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function index(){
        $today = date('Y-m-d');
        $total_students         = Student::count();
        $total_enrolled         = DB::table('semester_student as st')
                                    ->leftJoin('semesters as sem', 'st.semester_id', '=', 'sem.id')
                                    ->whereDate('sem.start_date', '<=', $today)
                                    ->whereDate('sem.end_date', '>=', $today)
                                    ->count();
        $total_achievements     = Achievement::count();
        $total_announcements    = Announcement::count();
        $total_materials        = Material::count();

        return Inertia::render('Dashboard', [
            'total_students'        => $total_students,
            'total_enrolled'        => $total_enrolled,
            'total_achievements'    => $total_achievements,
            'total_announcements'   => $total_announcements,
            'total_materials'       => $total_materials,
        ]);
    }
}
