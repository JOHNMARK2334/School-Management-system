<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //$courses= Courses::get();
        $categories = Category::get();
        return view('categories.index',compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request -> validate([
            'name' => 'required',
            'description' => 'required',
        ]);
        Category::create([
            "name"  =>$request-> name,
            "description" => $request -> description
        ]);
        return redirect()->route('categories.index')->with('success','category added successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $categories = Category::query()->where('id',$id)->first();
        return view('categories.show',compact('categories'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $categories = Category::query()->where('id',$id)->first();
        return view('categories.edit',compact('categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $request -> validate([
            'name' => 'required',
            'description' => 'required',
        ]);
        //dd("update");
        Category::query()->where('id',$request->id)-update([
            "name"=>$request->name,
            "description"=> $request->description,
        ]);
        return redirect()->route('categories.index')->with('success category updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $category = Category::query()->where('id',$category->id)->update(['is_active'=>false]);
        return back();
    }
}
