<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use App\Models\Account;
use App\Models\Course;
use App\Models\Category;
use App\Models\Department;
use App\Models\MPesa;
use App\Models\Role;
use App\Models\Staff;
use App\Models\Student;
use App\Models\Transaction;
use App\Models\Unit;
use App\Models\User;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $notifications= Notification::all();
        return view('pages.dashboard',compact('notifiations'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $account= Account::get();
        $course = Course::get();
        $department= Department::get();
        $category= Category::get();
        $mpesa= MPesa::get();
        $role= Role::get();
        $staff= Staff::get();
        $student= Student::get();
        $transaction= Transcation::get();
        $unit= Unit::get();
        $user= User::get();
        return view('pages.dashboard',compact('account','course','department','category','mpesa','role','staff','student','transaction','unit','user'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'message'=>'required',
            'account_id'=>'',
            'category_id'=>'',
            'course_id'=>'',
            'department_id'=>'',
            'mpesa_id'=>'',
            'role_id'=>'',
            'staff_id'=>'',
            'student_id'=>'',
            'transaction_id'=>'',
            'unit_id'=>'',
            'user_id'=>'',
        ]);
        $create= Notification::create([
            'message'=>$request->message,
            'account_id'=>$request->account_id,
            'category_id'=>$request->category_id,
            'course_id'=>$request->course_id,
            'department_id'=>$request->department_id,
            'mpesa_id'=>$request->mpesa_id,
            'role_id'=>$request->role_id,
            'staff_id'=>$request->staff_id,
            'student_id'=>$request->student_id,
            'transaction_id'=>$request->transaction_id,
            'unit_id'=>$request->unit_id,
            'user_id'=>$request->user_id,
        ]);
        return back();
    }

    /**
     * Display the specified resource.
     */
    public function show(Notification $notification)
    {
        $notification= Notification::query()->where('id',$notification->id)->first();
        return view('notifications.show');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Notification $notification)
    {
        $notification= Notification::query()->where('id',$notification->id)->first();
        delete();
        notify()->success(__('notification deleted successfully'));
        return redirect()->route('dashboard');
    }
}
