<?php

namespace App\Http\Controllers\V1;

use App\Models\Video;
use App\Models\Course;
use App\Models\Curriculum;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ApiController extends Controller
{
    public function show($id)
    {
        $course = Course::where('id', $id)->first();
        $videos = Video::where('course_id', $id)->get();
        $curricula = Curriculum::where('course_id', $id)->get();
        $curriculaData = [];
        foreach ($curricula as $curriculum) {
            $curriculaData[] = [
                'id' => $curriculum->id,
                'title' => $curriculum->title,
                'duration' => ('Кол-во часов: ' . $curriculum->duration),
                'lessons' => preg_split('/\s*,\s*/', $curriculum->themes),
            ];
        }
        $videosData = [];
        foreach ($videos as $video) {
            $videosData[] = [
                'id' => $video->id,
                'title' => $video->title,
                'duration' => $video->duration,
                'url' => url('storage/' . $video->url),
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
            'curriculum' => $curriculaData,
        ], 200);
    }
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
}
