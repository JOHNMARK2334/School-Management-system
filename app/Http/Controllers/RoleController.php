<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\Staff;
use App\Models\Department;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = Role::query()->where('is_active',true)->paginate(10);
        return view('courses.index',compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $staff = Staff::all();
        $departments = Department::all();
        return view('roles.create',compact('departments'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request -> validate([
            'name' =>['required'],//.$request->input("id"),
            'description'=>['required'],
            'department_id'=>[''],
        ]);
        $role = Role::create([
            "name" => $request->name,
            "description" =>  $request->description,
            "department_id" => $request -> department_id,
        ]);
        return redirect()->route('roles.index')->with('success','role created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $roles = Role::query()->where('id',$id)->first();
        return view('roles.show',compact('roles'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $roles = Role::query()->where('id',$id)->first();
        return view('roles.edit',compact('roles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Role $role)
    {
        $request -> validate([
            'name' =>'required',  //.$request->input("id"),
            'description'=>'required',
            'department_id'=>'required',
        ]);
        Role::query()->where('id',$role->id)->update([
            'name'=>$request->name,
            'description'=> $request->description,
            'description'=>$request->department_id
        ]);
        return redirect()->route('roles.index')->with('success','role details updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $role)
    {
        $role = Role::query()->where('id',$role->id)->update(['is_active' => false]);
        return back();
    }
}
