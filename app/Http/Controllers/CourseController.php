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
        return view("admin.courses.index", compact("courses"));
    }

    public function create()
    {
        return view('admin.courses.create');
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

        return redirect()->route('admin.courses.index')->with('success','Created');
    }
    public function destroy(Course $course)
    {
        $course->delete();
        return redirect()->route('admin.courses.index')->with('success','Deleted');
    }
    public function edit(Course $course)
    {
        return view('admin.courses.edit', compact('course'));
    }
    public function update(Request $request, Course $course)
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

        $course->update([
            'title'=> $request->title,
            'description'=> $request->description,
            'price'=> $request->price,
            'image'=> $imagePath,
            'category'=> $request->category,
            'features' => $request->features
        ]);
        return redirect()->route('admin.courses.index')->with('success','Updated');
    }
}
