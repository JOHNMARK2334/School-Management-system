<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Student;
use App\Models\Staff;
use App\Models\Category;
use App\Models\Department;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;
    /**public function __construct()
    {
        $this->middleware('auth');
    }
    protected static  function get_user()
    {
        return User::find(session()->get("id"));
    }*/
    //protected static   function isAdmin(){
        //return self::get_user()->role == "admin";
        //}
        /*public function index($name)
        {
            echo 'hello'.' '.$name.'!';
            }*/
    public function redirect()
    {
        return view('auth.login');
    }
    public function direct()
    {
        return view('auth.register');
    }
    public function dashboard()
    {
        $categories= Category::get();
        $departments = Department::get();
        $students = Student::get();
        //dd($students);
        $staff = Staff::get();
        $student = Student::query()->where('admission_year', 2023)->get();
        return view('pages.dashboard',compact('students','staff','student','departments','categories'));
        return view('pages.dashboard');
    }

}
