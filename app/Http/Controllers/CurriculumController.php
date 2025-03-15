<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Curriculum;
use Illuminate\Http\Request;

class CurriculumController extends Controller
{
    public function index()
    {
        $curriculum = Curriculum::all();
        return view("admin.curricula.index", compact("curriculum"));
    }
    public function create()
    {
        $courses = Course::all();
        return view("admin.curricula.create", compact("courses"));
    }
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'course_id' => 'required',
            'duration' => 'required',
            'themes' => 'required',
        ]);
        $curriculum = Curriculum::create($request->all());
        return redirect()->route('admin.curricula.index')->with('success','Created');
    }
    public function edit(Curriculum $curricula)
    {
        $courses = Course::all();
        return view('admin.curricula.edit', compact('courses','curricula'));
    }
    public function update(Request $request, Curriculum $curricula)
    {
        $request->validate([
            'title' => 'required',
            'course_id' => 'required',
            'duration' => 'required',
            'themes' => 'required',
        ]);
        $curricula->update($request->all());
        return redirect()->route('admin.curricula.index')->with('success','Updated');
    }
    public function destroy(Curriculum $curricula)
    {
        $curricula->delete();
        return redirect()->route('admin.curricula.index')->with('success','Deleted');
    }
}
