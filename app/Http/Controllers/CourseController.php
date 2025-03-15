<?php

namespace App\Http\Controllers;

use App\Models\Video;
use App\Models\Course;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function index()
{
    $courses = Course::all();

    $coursesData = [];

    foreach ($courses as $course) {
        $coursesData[] = [
            'id' => $course->id,
            'title' => $course->title,
            'description' => $course->description,
            'price' => $course->price,
            'image' => asset('storage/' . $course->image),
            'category' => $course->category,
            'features' => $course->features,
        ];
    }

    return response()->json($coursesData, 200);
    }
    public function show($id)
    {
        $course = Course::where('id', $id)->first();
        $videos = Video::where('course_id', $id)->get();
        $videosData = [];
        foreach ($videos as $video) {
            $videosData[] = [
                'id' => $video->id,
                'title' => $video->title,
                'duration' => $video->duration,
                'url' => $video->url,
            ];
        }
        return response()->json([
            'id' => $course->id,
            'title' => $course->title,
            'description' => $course->description,
            'price' => $course->price,
            'image' => asset('storage/' . $course->image),
            'category' => $course->category,
            'features' => $course->features,
            'videos' => $videosData,
        ], 200);
    }
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'price' => 'required',
            'image' => 'required|image',
            'category' => 'required',
            'features' => 'required',
        ]);

        $imagePath = $request->file('image')->store('images', 'public');

        $course = Course::create([
            'title' => $request->title,
            'description' => $request->description,
            'price' => $request->price,
            'image' => $imagePath,
            'category' => $request->category,
            'features' => $request->features,
        ]);

        return response()->json($course, 201);
    }
}
