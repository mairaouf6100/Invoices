<?php

namespace App\Http\Controllers;

use App\Sections;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\SectionRequest;
class SectionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sections=Sections::all();

        return view('sections.sections',compact('sections'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

            $validatedData=$request->validate([
                'section_name'=>'required|unique:sections|max:255',
                'description'=>'required',
            ],[

                'section_name.required' =>'يرجي ادخال اسم القسم',
                'section_name.unique' =>'اسم القسم مسجل مسبقا',

            ]);
           Sections::create([
            'section_name' => $request->section_name,
            'description' => $request->description,
            'created_by' => (Auth::user()->name),

        ]);

            return redirect('/sections');

        }






    /**
     * Display the specified resource.
     *
     * @param  \App\Sections  $sections
     * @return \Illuminate\Http\Response
     */
    public function show(Sections $sections)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Sections  $sections
     * @return \Illuminate\Http\Response
     */
    public function edit(Sections $sections)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Sections  $sections
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $id=$request->id;
        $this->validate($request, [

            'section_name' => 'required|max:255|unique:sections,section_name,'.$id,
            'description' => 'required',
        ],[

            'section_name.required' =>'يرجي ادخال اسم القسم',
            'section_name.unique' =>'اسم القسم مسجل مسبقا',
            'description.required' =>'يرجي ادخال البيان',

        ]);


        $sections=Sections::find($id);
        $sections->update([
            'section_name'=>$request->section_name,
            'description'=>$request->description,
        ]);

        return redirect('/sections')->with('success','تم التعديل');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Sections  $sections
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $id=$request->id;
        Sections::find($id)->delete();
        return redirect('/sections')->with('success','تم الحذف');

    }
}
