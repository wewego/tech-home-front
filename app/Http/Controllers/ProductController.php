<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $result = Product::all();
        return $result;
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
        $product = new Product;
        $product->productName = $request->productName;
        $product->productDescription = $request->productDescription;
        $product->productPrice = $request->productPrice;
        $product->productWeight = $request->productWeight;
        $product->productStock = $request->productStock;
        $result = $product->save();
        if($result){
            return ["result"=>"Product Added."];
        }
        else{
            return ["result"=>"Product Not Added."];
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $result = Product::find($id);
        return $result;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $product = Product::find($id);
        $product->productName = $request->productName;
        $product->productDescription = $request->productDescription;
        $product->productPrice = $request->productPrice;
        $product->productWeight = $request->productWeight;
        $product->productStock = $request->productStock;
        $result = $product->save();
        if($result){
            return ["result"=>"Product Updated."];
        }
        else{
            return ["result"=>"Product Not Updated."];
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::find($id);
        $result = $product->delete();
        if($result){
            return ["result"=>"Product Deleted."];
        }
        else{
            return ["result"=>"Product Not Deleted."];
        }
    }
}