<?php

namespace App\Http\Controllers;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use App\Models\Role;
use App\Models\Staff;
use App\Models\Notification;
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
        return view('roles.index',compact('roles'));
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
            'role_id'=>[''],
            'name' =>['required'],
            'short_name'=>['required'],//.$request->input("id"),
            'description'=>['required'],
            'department_id'=>[''],
        ]);
        //generate id
        $role_id= IdGenerator::generate(['table'=>'roles','field'=>'role_id','length'=>'7','prefix'=>$request->department_id.'-'.$request->short_name]);

        $role = Role::create([
            "role_id"=>$role_id,
            "name" => $request->name,
            "short_name"=>$request->short_name,
            "description" =>  $request->description,
            "department_id" => $request -> department_id,
        ]);
        //notification
        $rol_add= 'Role has been added successfully.';
        notify()->success(__($rol_add));
        $create= Notification::create([
            "message"=>$rol_add,
            "role_id"=>$request->id
        ]);
        return redirect()->route('roles.index');
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
        $departments= Department::all();
        $roles = Role::query()->where('id',$id)->first();
        return view('roles.edit',compact('roles','departments'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $request -> validate([
            'name' =>'required', 
            'short_name'=>'required',//.$request->input("id") ,
            'description'=>'required',
            'department_id'=>'required',
        ]);
        Role::query()->where('id',$request->id)->update([
            'name'=>$request->name,
            'short_name'=>$request->short_name,//.$request->input("id"),
            'description'=> $request->description,
            'department_id'=>$request->department_id
        ]);
        $rol_update=$request->name. 'has been updated successfully.';
        notify()->success(__($rol_update));
        $create= Notification::create([
            "message"=>$rol_update,
            "role_id"=>$request->id
        ]);
        return redirect()->route('roles.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $role)
    {
        $role = Role::query()->where('id',$role->id)->update(['is_active' => false]);
        $rol_delete= 'Role has been deleted successfully.';
        notify()->success(__($rol_delete));
        $create= Notification::create([
            "message"=>$rol_delete,
            "role_id"=>$role
        ]);
        return back();
    }
}
