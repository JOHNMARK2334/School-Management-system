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
        $course = Course::all();
        return view('units.create',compact('course'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request -> validate([
            'name' =>'required',
            'description' =>'required',
        ]);
        $unit = Unit::create([
            "name" => $request->name,
            "description" => $request->description
        ]);
        foreach($request ->course as $course)
        {
            Course::create([
                "unit_id" => $unit->id,
                "course_id" => $course,
            ]);
        }
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
        $unit = Unit::query()->where('is_active',true)->first();
        if ($unit)
        {
            $unit -> update(['is_active'== false]);
        }
        else
        {
            abort(403,'Unit not found');
        }
        return back();
    }
}
