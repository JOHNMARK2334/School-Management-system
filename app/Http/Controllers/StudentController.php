<?php

namespace App\Http\Controllers;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use App\Models\Student;
use App\Http\Controllers\QrCodeController;
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
            'student_id'=>'',
            'name' =>'required',
            'photo'=>'required',
            'email'=>'required',
            'phone_number'=>'required',
            'date_of_birth'=>'required',
            'course_id'=>'required',
            'admission_year'=>'required',
            'qrcode'=>''
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
        if($request->file('qrcode'))
        {
            echo "404 error";
        }
        else
        {
            $qrcode=QrCode::size(100)
                        ->format('png')
                        ->generate('', public_path('public/Image/'));
        }
        $date = date('Y', time());
        //generate student id
        $cse = Course:: query()->where('course_id',$request->course_id)->first();
        $student_id= IdGenerator::generate(['table' => 'students', 'field'=>'student_id','length'=>'17','prefix'=>$cse->course_id.'-'],$reset = false);
        $create= Student::create([
            "student_id"=>$student_id,
            "name"=>$request->name,
            "photo"=>$filename,
            "email"=>$request->email,
            "phone_number"=>$request->phone_number,
            "date_of_birth"=>$request->date_of_birth,
            "course_id"=>$request->course_id,
            "admission_year"=>$date,
            "qrcode"=>$qrcode
        ]);
        $id= Student::query()->where('id',$create->id)->first();
        $student_id= IdGenerator::generate(['table' => 'students', 'field'=>'student_id','length'=>'17','prefix'=>$cse->course_id.'-'.$id.'/'.$date],$reset = false);
        $qrcode = QrCode::size(100)->generate($create->id.''.$create->student_id.''.$create->name.''.$create->photo.''.$create->email.''.$create->phone_number.''.$create->date_of_birth.''.$create->course_id.''.$create->admission_year);            
        Student::query()->where('id',$id)->update([
            'student_id'=>$student_id,
            'qrcode'=>$qrcode
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
        $courses = Course::get();
        $students= Student::query()->where('id',$id)->first();
        return view('students.edit',compact('students','courses'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
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
            $filename=$student['photo'];
        }

        Student::query()->where('id',$request->id)->update([
            'name'=>$request->name,
            'photo'=> $filename,
            'email' =>$request->email,
            'phone_number'=>$request->phone_number,
            'date_of_birth'=>$request->date_of_birth,
            'course_id'=>$request->course_id,
            'admission_year'=>$request->admission_year
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
