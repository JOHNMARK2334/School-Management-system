<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Role;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $departments = Department::query()->where('is_active',true)->get();
        //dd($departments);
        return view('departments.index',compact('departments'));
    }
    // Fetch records
    public function getRoles($department){
    	// Fetch Roles by Departmentid
        $roleData['data'] = Role::orderby('name','asc')
        			->where('department_id',$department->id)
        			->get();  
        return response()->json($roleData);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('departments.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required'],
            'short_name' => ['required'],
            'department_head '=> [''],
            'description' => ['required'],
        ]);
        $department= Department::create([
            "name"=>$request->name,
            "short_name"=>$request->short_name,
            "department_head"=> $request->department_head,
            "description" => $request->description
        ]);
        return redirect()->route('departments.index')->with('success','department added successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $departments = Department::query()->where('id',$id)->first();
        return view('departments.show',compact('departments'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $departments = Department::query()->where('id',$id)->first();
        return view('departments.edit',compact('departments'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Department $department)
    {
        $request -> validate([
            'name' =>'required',
            'short_name'  => 'required',
            'dept_head' => 'required',
            'description' => 'required',
        ]);
        $department = Department::query()->where('id',$department->id)->update([
            'name'=>$request->name,
            'short_name'=>$request->short_name,
            'dept_head'=> $request->dept_head,
            'description'=>$request->description,
        ]);
        if ($department)
        {
            session(['success'=>'updated']);
            return redirect('departments.index');
        }
        else
        {
            session(['error'=>'not updated']);
            return back();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Department $department)
    {
        //dd($department);
        $department = Department::query()->where('id' ,$department->id)->update(['is_active'=> false]);
        return back();
    }
}
