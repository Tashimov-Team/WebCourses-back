<?php

namespace App\Http\Controllers;

use App\Models\Video;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class VideoController extends Controller
{
    public function index()
    {
        $videos = Video::all();
        return view("admin.video.index", compact("videos"));
    }
    public function create()
    {
        $courses = Course::all();
        return view("admin.video.create", compact("courses"));
    }
    public function store(Request $request)
    {
        $videoPath = $request->file('video')->store('videos', 'public');

        $video = Video::create([
            'course_id' => $request->course_id,
            'title'=> $request->title,
            'duration'=> $request->duration,
            'url'=> $videoPath
        ]);
        return redirect()->route('admin.videos.index')->with('success','Created');
    }
    public function show(Video $video)
    {
        $url = asset('storage/' . $video->url);
        return view('admin.video.show', compact('url'));
    }
    public function edit(Video $video)
    {
        $courses = Course::all();
        return view('admin.video.edit', compact('courses','video'));
    }
    public function update(Video $video, Request $request)
    {
        $request->validate([
            'video' => 'nullable|file',
            'title' => 'required|string|max:255',
            'duration' => 'required',
            'course_id' => 'required',
        ]);

        if ($request->hasFile('video')) {
            if ($video->url) {
                Storage::disk('public')->delete($video->url);
            }

            $videoPath = $request->file('video')->store('videos', 'public');
        }

        $video->update([
            'course_id' => $request->course_id,
            'title' => $request->title,
            'duration' => $request->duration,
            'url'=> $videoPath
        ]);

        return redirect()->route('admin.videos.index')->with('success', 'Updated');
    }
    public function destroy(Video $video)
    {
        if ($video->url) {
            Storage::disk('public')->delete($video->url);
        }
        $video->delete();
        return redirect()->route('admin.videos.index')->with('success','Deleted');
    }
}
