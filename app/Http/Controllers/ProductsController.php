<?php

namespace App\Http\Controllers;

use App\Products;
use App\Sections;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sections=Sections::all();
        $products=Products::all();
        return view('products.products',compact('sections','products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        // $validatedData=$request->validate([
        //     'products_name'=>'required|unique:products|max:255',
        //     'description'=>'required',
        //     'section_id' =>'required',
        // ],[

        //     'products_name.required' =>'يرجي ادخال اسم المنتج',
        //     'products_name.unique' =>'اسم المنتج مسجل مسبقا',
        //     'section_id.required'=>'يرجي اختيار القسم',

        // ]);





        Products::create([
            'products_name' => $request->products_name,
            'section_id' => $request->section_id,
            'description' => $request->description,



        ]);


     return redirect('/products')->with('success','تم اضافه المنتج');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Products  $products
     * @return \Illuminate\Http\Response
     */
    public function show(Products $products)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Products  $products
     * @return \Illuminate\Http\Response
     */
    public function edit(Products $products)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Products  $products
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $id=Sections::where('section_name',$request->section_name)->first()->id;

        $products=Products::findOrFail($request->pro_id);
        $products->update([
            'products_name'=>$request->products_name,
            'description'=>$request->description,
            'section_id' => $id,
        ]);

        return redirect('/products')->with('success','تم التعديل');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Products  $products
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $products=Products::findOrFail($request->pro_id);
        $products->delete();
        return redirect('/products')->with('success','تم الحذف');

    }
}
