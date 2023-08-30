<?php

namespace App\Http\Controllers;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use App\Models\Staff;
use App\Models\Role;
use App\Models\Department;
use Illuminate\Http\Request;

class StaffController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $staff = Staff::query()->where('is_active',true)->paginate(10);
        return view('staff.index',compact('staff'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles=Role::all();
        $departments=Department::all();
            // Fetch departments
            $departmentData['data'] = Department::orderby("name","asc")
            ->select('id','name')
            ->get();

        // Load index view
       return view('staff.create',compact('roles','departments'))->with("departmentData",$departmentData);
    }
    // Fetch records
    public function getEmployees($id){
    	// Fetch Employees by Departmentid
        $empData['data'] = Role::orderby("name","asc")
        			->select('id','name')
        			->where('department_id',$id)
        			->get();
        return response()->json($empData);
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request -> validate([
            'staff'=>'required',
            'photo' =>'required',
            'name' =>'required',
            'email'=>'required',
            'phone_number'=>'required',
            'address'=>'required',
            'department_id'=>'required',
            'role_id' => 'required'
        ]);
        if($request->file('photo'))
        {
            $file= $request->file('photo');
            $filename= date('YmdHi').$file->getClientOriginalName();
            $file ->move(public_path('public/Image'),  $filename);
        }
        else
        {
            echo "Please select file";
        }
        $staff = Staff::create([
            "staff"=>$request->staff,
            "photo"=>$filename,
            "name"=>$request->name,
            "email"=>$request->email,
            "phone_number"=>$request->phone_number,
            "address"=>$request->address,
            "department_id"=>1,
            "role_id" =>1
        ]);
        notify()->success(__('Staff has been added successfully.'));
        return redirect()->route('staff.index');
    }
    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $staff = Staff::query()->where('id',$id)->first();
        return view('staff.show',compact('staff'));
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $staff = Staff::query()->where('id',$id)->first();
        return view('staff.edit',compact('staff'));
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Staff $staff)
    {
        $request -> validate([
            'staff_id'=>'required',
            'name'=>'required',
            'photo'=>'required',
            'email'=>'required',
            'phone_number'=>'required',
            'address' =>'required',
        ]);
        if($request->file('photo'))
        {
            $file= $request->file('photo');
            $filename= date('YmdHi').$file->getClientOriginalName();
            $file-> move(public_path('public/Image'), $filename);
        }
        else
        {
            $filename=$staff['photo'];
        }
        Staff::query()->where('id',$staff->id)->update([
            'staff_id'=>$request->staff_id,
            'name'=>$request-> name,
            'photo'=> $filename,
            'email'=>$request-> email,
            'phone_number'=>$request-> phone_number,
            'address'=>$request-> address
        ]);
        notify()->success(__('Staff details have been updated successfully.'));
        return redirect()->route('staff.index');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Staff $staff)
    {
        $staff = Staff::query()->where('id',$staff->id)->update(['is_active'=>false]);
        notify()->success(__('Staff has been deleted successfully.'));
        return back();
    }
}
