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
        //notification
        $dep_add= 'Department has been added successfully.';
        notify()->success(__($dep_add));
        return redirect()->route('departments.index');
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
    public function update(Request $request)
    {
        $request -> validate([
            'name' =>'required',
            'short_name'  => 'required',
            'description' => 'required',
        ]);
        $department = Department::query()->where('id',$request->id)->update([
            'name'=>$request->name,
            'short_name'=>$request->short_name,
            'description'=>$request->description,
        ]);
        if ($department)
        {
            session(['success'=>'updated']);
            $dep_update= $request->name.'has been updated successfully.';
            notify()->success(__($dep_update));
            return redirect()->route('departments.index');
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
        $dep_delete='Department has been deleted successfully.';
        notify()->success(__($dep_delete));
        return back();
    }
}
