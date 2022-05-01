<?php

namespace App\Http\Controllers;

use App\Models\Products;
use Illuminate\Http\Request;
use Auth;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        $products = Products::where('user_id',$user->id)->get();
        return response()->json(['status'=>200, 'products'=>$products],200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = Auth::user();
        $product = new Products();
        $product->name = $request->name;
        $product->description = $request->description;
        $product->unit_value = $request->unit_value;
        $product->user_id = $user->id;

        $product->save();

        return response()->json(['status'=>200, 'message'=>'Producto Creado']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Products  $products
     * @return \Illuminate\Http\Response
     */
    public function show(Products $products)
    {
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Products  $products
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $updateProduct = Products::findOrFail($id);
        $updateProduct->name = $request->name;
        $updateProduct->description = $request->description;
        $updateProduct->unit_value = $request->unit_value;
        $updateProduct->update();

        return response()->json(['status'=>200, 'message'=>'Producto Actualizado'],200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Products  $products
     * @return \Illuminate\Http\Response
     */
    public function destroy(Products $products)
    {
        //
    }
}
