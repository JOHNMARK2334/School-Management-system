<?php

namespace App\Http\Controllers;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use App\Models\Course;
use App\Models\Unit;
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
        $unit= Unit::get();
        $courses = Course::query()->where('is_active', true)->get();
        return view('courses.index',compact('courses','unit'));
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
            'course_id'=>'',
            'name' =>'required',
            'short_name'=>'required',
            'number'=>'required',
            'description'=>'required',
            'duration'=>'required',
            'department_id'=>'required',
            'category_id'=>'required'
        ]);
        //generate course id
        $dept=Department::query()->where('id', $request->department_id)->first();
        $course_id= IdGenerator::generate(['table' => 'courses', 'field'=>'course_id','length'=>'7','prefix'=>$dept->short_name.'-'.$request->number],$reset = false);
        // if($dept){
        //     $prefix=$dept['code'];
        //     }else{$prefix='0';}
        //     $generator = IdGenerator::make(['table' => 'courses',  'field' => 'course_id', 'length' =>1
        //     2, 'prefix'=>$prefix]);
        //     try {
        //         $courseId = $generator->generate();
        //         } catch (Exception $e) {
        //             dd("Error: " . $e);
        //             };
        Course::create([
            "course_id"=>$course_id,
            "name"=>$request->name,
            "short_name"=>$request->short_name,
            "number"=>$request->number,
            "description"=> $request->description,
            "duration"=> $request->duration,
            "department_id"=>$request->department_id,
            "category_id"=>$request->category_id
        ]);
        //notification
        notify()->success(__('Course has been added successfully.'));
        return redirect()->route('courses.index');
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
        $departments = Department::all();
        $categories = Category::all();
        $courses = Course::query()->where('id',$id)->first();
        return view('courses.edit',compact('courses','departments','categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $request -> validate([
            'name' =>'required|string|max:255',
            'short_name'=>'required',
            'number'=>'required',
            'duration'=>'required',
            'description'=>'required',
            'department_id'=>'required',
            'category_id'=>'required'
        ]);
        Course::query()->where('id',$request->id)->update([
            'name'=>$request->name,
            'short_name'=>$request->short_name,
            'number'=>$request->number,
            'duration'=> $request->duration,
            'description'=>$request->description,
            'department_id'=>$request->department_id,
            'category_id'=>$request->category_id
        ]); 
        //notification
        notify()->success(__('Course has been updated successfully.'));
        return redirect()->route('courses.index');
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
