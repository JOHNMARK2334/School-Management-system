<?php

namespace App\Http\Controllers;

use App\Models\Unit;
use App\Models\Course;
use Illuminate\Http\Request;

class UnitController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $units = Unit::orderBy('id','asc')->paginate(10);
        return view('units.index',compact(['units']));
    }
    
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $courses = Course::all();
        return view('units.create',compact('courses'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request -> validate([
            'name' =>'required',
            'description' =>'required',
            'course_id'=>'required',
            'year'=>'required',
            'semester'=>'required'
        ]);
        Unit::create([
            "name" => $request->name,
            "description" => $request->description,
            "course_id"=>$request->course_id,
            "year"=> $request->year ,
            "semester"=>  $request->semester
        ]);
        return redirect()->route('units.index')->with('success','unit added successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $units = Unit::query()->where('id',$id)->first();
        return view('units.show',compact('units'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $units = Unit::query()->where('id',$id)->first();
        return view('units.edit',compact('units'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Unit $unit)
    {
        $request -> validate([
            'name' => 'required',
            'description' => 'required',
        ]);
        $unit = Unit::query()->where('id',$unit->id)->update([
            "name" => $request->name,
            "description" => $request->description
        ]);
        return redirect()->route('units.index')->with('success','unit details updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Unit $unit)
    {
        $unit = Unit::query()->where('id',$unit->id)->update(['is_active'=>false]);
        return back();
    }
}
