<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use Illuminate\Http\Request;
use Inertia\Inertia;

class AnnouncementController extends Controller
{
    public function index()
    {
        $announcements = Announcement::where('status', 'active')->latest('publish_date')->get();
        $storage_link = asset('storage/images/announcements');
        return Inertia::render('Announcement/Index', [
            'announcements'  => $announcements,
            'storage_link'   => $storage_link,
        ]);
    }

    public function getSingleAnnouncement(Request $request)
    {
        $announcement = Announcement::with('images')->find($request->id);
        $more_announcements = Announcement::where('status', 'active')->where('id', '!=', $request->id)->latest('publish_date')->take(10)->get();
        $storage_link = asset('storage/images/announcements');
        return Inertia::render('Announcement/Id', [
            'announcement'          => $announcement,
            'more_announcements'    => $more_announcements,
            'storage_link'          => $storage_link,
        ]);
    }
}
