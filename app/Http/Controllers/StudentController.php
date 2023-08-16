<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Course;
use Illuminate\Http\Request;
use Carbon;
class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $students = Student::query()->where('is_active', true)->get();
        return view('students.index',compact('students'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $courses = Course::all();
        return view('students.create',compact('courses'));
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request -> validate([
            'name' =>'required',
            'photo'=>'required',
            'email'=>'required',
            'phone_number'=>'required',
            'date_of_birth'=>'required',
            'course_id'=>'required',
            'admission_year'=>'required'
        ]);
        if($request->file('photo'))
        {
            $file= $request->file('photo');
            $filename= date('YmdHi').$file->getClientOriginalName();
            $file-> move(public_path('public/Image'), $filename);
        }
        else
        {
            echo "Please select file";
        }
        $date = date('Y', time());
        Student::create([
            "name"=>$request->name,
            "photo"=>$filename,
            "email"=>$request->email,
            "phone_number"=>$request->phone_number,
            "date_of_birth"=>$request->date_of_birth,
            "course_id"=>$request->course_id,
            "admission_year"=>$date
        ]);
        
        return redirect()->route('students.index')->with('success','Student added successfully');
    }
    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $students = Student::query()->where('id',$id)->first();
        return view('students.show',compact('students'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $students = Student::query()->where('id',$id)->first();
        return view('students.edit',compact('students'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Student $student)
    {
        $request -> validate([
            'name' =>'required',
            'photo'=>'required',
            'email'=>'required',
            'phone_number'=>'required',
            'date_of_birth'=>'required',
        ]);
        if($request->file('photo'))
        {
            $file= $request->file('photo');
            $filename= date('YmdHi').$file->getClientOriginalName();
            $file-> move(public_path('public/Image'), $filename);
        }
        else
        {
            $filename=$student['photo'];
        }
        Student::query()->where('id',$student->id)->update([
            "name"=>$request-> name,
            "photo"=> $filename,
            "email" =>$request-> email,
            "phone_number"=>$request-> phone_number,
            "date_of__birth"=>$request-> date_of_birth,
        ]);
        return redirect()->route('students.index')->with('success','Student details updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Student $student)
    {
        $student = Student::query()->where('id',$student->id)->update(['is_active'=> false]);
        return back();
    }
}
