<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class AchievementController extends Controller
{
    public function index(){
        return Inertia::render('Admin/Achievement/Index');
    }
}
