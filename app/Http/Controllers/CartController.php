<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $cart = new Cart;
        $products_id = explode(',' ,$request->products_id);
        $stored_products = "";
        for ($i = 0; $i < count($products_id); $i++){
            $stored_products = $stored_products.$products_id[$i]."\n";
        }
        $cart->products_id = $stored_products;


        $quantities = explode(',' ,$request->quantities);
        $stored_quantities = "";
        for ($i = 0; $i < count($quantities); $i++){
            $stored_quantities = $stored_quantities.$quantities[$i]."\n";
        }
        $cart->quantities = $stored_quantities;

        $prices = explode(',' ,$request->prices);
        $stored_prices = "";
        for ($i = 0; $i < count($prices); $i++){
            $stored_prices = $stored_prices.$prices[$i]."\n";
        }
        $cart->prices = $stored_prices;


        $total_price = 0;
        for ($i = 0; $i < count($prices); $i++){
            $total_price = $total_price + (int)$quantities[$i] * (int)$prices[$i];
        }
        $cart->total_price = $total_price;
        $cart->user_id = $request->user_id;
        $carts = Cart::where('user_id', $request->user_id)->first();
        if ($carts == null){
            $result = $cart->save();
            if ($result){
                return ["result"=>"Cart added",
                "has_cart" => "true",
                 "id" => $cart->id
                ];
            }
        else{
            return ["result"=>"Cart not added"];
        }

        }
        else{
            return ["message"=>"You already has a cart"];
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
        $result = Cart::find($id);
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
        $cart = Cart::find($id);
        $products_id = explode(',' ,$request->products_id);
        $stored_products = "";
        for ($i = 0; $i < count($products_id); $i++){
            $stored_products = $stored_products.$products_id[$i]."\n";
        }
        $cart->products_id = $stored_products;


        $quantities = explode(',' ,$request->quantities);
        $stored_quantities = "";
        for ($i = 0; $i < count($quantities); $i++){
            $stored_quantities = $stored_quantities.$quantities[$i]."\n";
        }
        $cart->quantities = $stored_quantities;

        $prices = explode(',' ,$request->prices);
        $stored_prices = "";
        for ($i = 0; $i < count($prices); $i++){
            $stored_prices = $stored_prices.$prices[$i]."\n";
        }
        $cart->prices = $stored_prices;


        $total_price = 0;
        for ($i = 0; $i < count($prices); $i++){
            $total_price = $total_price + (int)$quantities[$i] * (int)$prices[$i];
        }
        $cart->total_price = $total_price;
        $cart->user_id = $request->user_id;
        $result = $cart->save();
        if ($result){
            return ["result"=>"Cart updated",
                "has_cart" => "true",
                 "id" => $cart->id
                ];
        }
        else{
            return ["result"=>"Cart not updated"];
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
        $cart = Cart::find($id);
        $result = $cart->delete();
        if ($result){
            return ["result"=>"Cart is deleted"];
        }
        else{
            return ["result"=>"Cart not deleted"];
        }
    }
}
