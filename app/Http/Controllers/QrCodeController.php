<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Staff;

class QrCodeController extends Controller
{
    public function index()
    {
        $students= Student::all();
        $staff= Staff::all();
        return view('qrCode',compact('students','staff'));
    }
}
