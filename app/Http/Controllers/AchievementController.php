<?php

namespace App\Http\Controllers;

use App\Models\Achievement;
use Illuminate\Http\Request;
use Inertia\Inertia;

class AchievementController extends Controller
{
    public function index(){
        $achievements = Achievement::where('status', 'active')->latest('publish_date')->get();
        $storage_link = asset('storage/images/achievements');
        return Inertia::render('Achievement/Index', [
            'achievements'  => $achievements,
            'storage_link'  => $storage_link,
        ]);
    }

    public function getSingleAchievement(Request $request)
    {
        $achievement = Achievement::with('images')->find($request->id);
        $more_achievements = Achievement::where('status', 'active')->where('id', '!=', $request->id)->latest('publish_date')->take(10)->get();
        $storage_link = asset('storage/images/achievements');
        return Inertia::render('Achievement/Id', [
            'achievement'          => $achievement,
            'more_achievements'    => $more_achievements,
            'storage_link'         => $storage_link,
        ]);
    }
}
