<?php

namespace App\Http\Controllers\V1;

use App\Models\Video;
use App\Models\Course;
use App\Models\Curriculum;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\UserVideoProgress;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

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
    public function updateProgress(Request $request)
    {
        $request->validate([
            'video_id' => 'required|integer',
            'progress' => 'required|numeric|min:0',
        ]);

        $user = Auth::user();
        $existingProgress = UserVideoProgress::firstOrNew([
            'user_id' => $user->id,
            'video_id' => $request->video_id,
        ]);
        if ($existingProgress->exists && $existingProgress->progress >= $request->progress) {
            return response()->json([
                'message' => 'Прогресс сохранён (текущий прогресс больше запрошенного)',
                'data' => $existingProgress,
            ], 200);
        }
        $existingProgress->progress = $request->progress;
        $existingProgress->save();

        return response()->json([
            'message' => 'Прогресс обновлён',
            'data' => $existingProgress,
        ], 200);
    }
    public function getUserCoursesProgress(Request $request)
    {
        $user = $request->user();

        $purchasedCoursesIds = is_array($user->purchased_courses)
            ? $user->purchased_courses
            : explode(',', $user->purchased_courses ?? '');

        if (empty($purchasedCoursesIds)) {
            return response()->json([]);
        }

        $courses = Course::whereIn('id', $purchasedCoursesIds)->get();
        $progressData = [];

        foreach ($courses as $course) {
            $videos = Video::where('course_id', $course->id)->get();

            if ($videos->isEmpty()) {
                $progressData[$course->id] = 0;
                continue;
            }

            $totalDuration = $videos->sum(fn($video) => $this->convertDurationToSeconds($video->duration));

            if ($totalDuration == 0) {
                $progressData[$course->id] = 0;
                continue;
            }
            $watchedSeconds = UserVideoProgress::where('user_id', $user->id)
                ->whereIn('video_id', $videos->pluck('id'))
                ->sum('progress');
            $courseProgress = round(($watchedSeconds / $totalDuration) * 100);
            $progressData[$course->id] = $courseProgress;
        }

        return response()->json($progressData);
    }
    private function convertDurationToSeconds($time): int
    {
        $parts = explode(':', $time);
        $count = count($parts);

        if ($count === 2) {
            return ($parts[0] * 60) + $parts[1];
        } elseif ($count === 3) {
            return ($parts[0] * 3600) + ($parts[1] * 60) + $parts[2];
        }

        return 0;
    }

}
