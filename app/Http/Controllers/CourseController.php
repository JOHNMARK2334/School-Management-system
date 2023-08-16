<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Department;
use App\Models\Category;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $courses = Course::query()->where('is_active', true)->get();
        return view('courses.index',compact('courses'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories= Category::all();
        $departments = Department::all();
        return view('courses.create',compact('departments','categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request -> validate([
            'course_id'=>'required',
            'name' =>'required',
            'short_name'=>'required',
            'number'=>'required',
            'description'=>'required',
            'duration'=>'required',
            'department_id'=>'required',
            'category_id'=>'required'
        ]);
        Course::create([
            "course_id"=>$request->course_id,
            "name"=>$request->name,
            "short_name"=>$request->short_name,
            "number"=>$request->number,
            "description"=> $request->description,
            "duration"=> $request->duration,
            "department_id"=>$request->department_id,
            "category_id"=>$request->category_id
        ]);
        return redirect()->route('courses.index')->with('success','course created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $courses = Course::query()->where('id',$id)->first();
        return view('courses.show',compact('courses'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $courses = Course::query()->where('id',$id)->first();
        return view('courses.edit',compact('courses'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Course $course)
    {
        $request -> validate([
            'course_id'=>'required',
            'name' =>'required|string|max:255',
            'short_name'=>'required',
            'number'=>'required',
            'duration'=>'required',
            'description'=>'required',
        ]);
        Course::query()->where('id',$course->id)->update([
            'course_id'=>$request->course_id,
            'name'=>$request->name,
            'short_name'=>$request->short_name,
            'number'=>$request->number,
            'duration'=> $request->duration,
            'description'=>$request->description,
        ]); 
        return redirect()->route('courses.index')->with('success','course details updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Course $course)
    {
        $course = Course::query()->where('id', $course->id)->update(['is_active'=>false]);
        return back() ;
    }
}
