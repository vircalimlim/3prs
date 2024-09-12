<?php

namespace App\Http\Controllers;

use App\Models\Achievement;
use Illuminate\Http\Request;
use Inertia\Inertia;

class AchievementController extends Controller
{
    public function index(){
        $achievements = Achievement::latest('created_at')->get();
        $storage_link = asset('storage/images/achievements');
        return Inertia::render('Achievement/Index', [
            'achievements'  => $achievements,
            'storage_link'  => $storage_link,
        ]);
    }

    public function getSingleAchievement(Request $request)
    {
        $achievement = Achievement::find($request->id);
        $more_achievements = Achievement::where('id', '!=', $request->id)->latest('created_at')->take(10)->get();
        $storage_link = asset('storage/images/achievements');
        return Inertia::render('Achievement/Id', [
            'achievement'          => $achievement,
            'more_achievements'    => $more_achievements,
            'storage_link'         => $storage_link,
        ]);
    }
}
