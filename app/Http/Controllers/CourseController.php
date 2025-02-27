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
        return response()->json($courses, 200);
    }
    public function show($id)
    {
        $course = Course::where('id', $id)->first();
        $videos = Video::where('course_id', $course->id);
        return response()->json([
            'id' => $course->id,
            'title' => $course->title,
            'description' => $course->description,
            'price' => $course->price,
            'image' => asset('storage/' . $course->image),
            'category' => $course->category,
            'features' => $course->features,
            'videos' => [
                'id' => $videos->id,
                'title' => $videos->title,
                'duration' => $videos->duration,
                'url' => $videos->url,
            ]
        ], 200);
    }
}
