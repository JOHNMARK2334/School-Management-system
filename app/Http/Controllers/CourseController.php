<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Department;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $courses = Course::orderBy('id','asc')->paginate(10);
        return view('courses.index',compact('courses'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $departments = Department::all();
        return view('courses.create',compact('departments'));
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
        ]);
        $course = Course::create([
            "course_id"=>$request->course_id,
            "name"=>$request->name,
            "short_name"=>$request->short_name,
            "number"=>$request->number,
            "description"=> $request->description,
            "duration"=> $request->duration
        ]);
        foreach($request->department as $department)
        {
            Department::create([
                "course_id"=>$course->id,
                "department_id"=>$department,
            ]);
        }
        return view('courses.index')->with('success','course created successfully');
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
        $course = Course::query()->where('is_active', true)->first();
        if($course)
        {
            $course -> update(['is_active' == false]);
        }
        else
        {
            abort (403,'Course not found');
        }
        return back() ;
    }
}
