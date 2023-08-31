<?php

namespace App\Http\Controllers;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use App\Models\Student;
use App\Http\Controllers\QrCodeController;
use App\Models\Course;
use App\Models\Notification;
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
        //dd($request);
        $date = date('Y', time());
        //generate student id
        $cse = Course:: query()->where('course_id',$request->course_id)->first();
        //dd($request);
        $student_id= IdGenerator::generate(['table' => 'students', 'field'=>'student_id','length'=>'13','prefix'=>$cse->course_id.'-'],$reset = true);
        $create= Student::create([
            "student_id"=>$student_id,
            "name"=>$request->name,
            "photo"=>$filename,
            "email"=>$request->email,
            "phone_number"=>$request->phone_number,
            "date_of_birth"=>$request->date_of_birth,
            "course_id"=>$request->course_id,
            "admission_year"=>$date,
        ]);
        //dd($create);
        $id= Student::query()->where('id',$create->id)->first();
        //dd($id);
       
        $qrcode = QrCode::size(100)
                    ->format('png')
                    ->generate(''.$create->student_id.''.$create->name.''.$create->email.''.$create->phone_number.''.$create->course_id.''.$create->admission_year,public_path('public/Image/'.$create->name.'.png')); 
//                   get the image name
        $cr=$create->name.'.png';
        //dd($create);         
        Student::query()->where('id',$id->id)->update([
           
            'qrcode'=>$cr
        ]);
        //dd($request); 
        $stud_add= 'Student has been added successfully.'; 
        notify()->success(__($stud_add)); 
        $create= Notification::create([
            "message"=>$stud_add_add,
            "student_id"=>$request->id
        ]); 
        return redirect()->route('students.index');
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
        $stud_update= $request->name. 's details have been updated successfully.';
        notify()->success(__($stud_update));
        $create= Notification::create([
            "message"=>$stud_update,
            "student_id"=>$request->id
        ]);
        return redirect()->route('students.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Student $student)
    {
        $student = Student::query()->where('id',$student->id)->update(['is_active'=> false]);

        $stud_delete= 'Student has been deleted successfully.';
        notify()->success(__($stud_delete));
        $create= Notification::create([
            "message"=>$stud_delete,
            "student_id"=>$student
        ]);
        return back();
    }
}
