<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\StaffController;

class QrCodeController extends Controller
{
    public function index()
    {
        $students= Student::all();
        $staff= Staff::all();
        return view('qrCode',compact('students','staff'));
    }
}
