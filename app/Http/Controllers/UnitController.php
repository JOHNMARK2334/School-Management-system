<?php

namespace App\Http\Controllers;
use Haruncpi\LaravelIdGenerator\IdGenerator;
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
        return view('units.create', compact('courses'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request -> validate([
            'unit_id'=>'',
            'name' =>'required',
            'description' =>'required',
            'course_id'=>'required',
            'year'=>'required',
            'semester'=>'required'
        ]);
        //generate unit id
        $cse= Course::query()->where('id',$request->course_id)->first();
        $unit_id= IdGenerator::generate(['table' => 'units', 'field'=>'unit_id','length'=>'7','prefix'=>$cse->short_name.'-'.$request->year.$request->semester],$reset = false);
        Unit::create([
            "unit_id"=>$unit_id,
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
        $courses= Course::all();
        $units = Unit::query()->where('id',$id)->first();
        return view('units.edit',compact('units','courses'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $request -> validate([
            'name' =>'required',
            'description' =>'required',
            'course_id'=>'required',
            'year'=>'required',
            'semester'=>'required'
        ]);
        Unit::query()->where('id',$request->id)->update([
            "name" => $request->name,
            "description" => $request->description,
            "course_id"=>$request->course_id,
            "year"=> $request->year ,
            "semester"=>  $request->semester
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
