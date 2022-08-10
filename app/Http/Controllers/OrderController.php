<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;

class OrderController extends Controller
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
        $order = new Order;
        $products_id = explode(',' ,$request->products_id);
        $stored_products = "";
        for ($i = 0; $i < count($products_id); $i++){
            $stored_products = $stored_products.$products_id[$i]."\n";
        }
        $order->products_id = $stored_products;


        $quantities = explode(',' ,$request->quantities);
        $stored_quantities = "";
        for ($i = 0; $i < count($quantities); $i++){
            $stored_quantities = $stored_quantities.$quantities[$i]."\n";
        }
        $order->quantities = $stored_quantities;

        $prices = explode(',' ,$request->prices);
        $stored_prices = "";
        for ($i = 0; $i < count($prices); $i++){
            $stored_prices = $stored_prices.$prices[$i]."\n";
        }
        $order->prices = $stored_prices;


        $total_price = 0;
        for ($i = 0; $i < count($prices); $i++){
            $total_price = $total_price + (int)$quantities[$i] * (int)$prices[$i];
        }
        $order->total_price = $total_price;
        $order->user_id = $request->user_id;
        $orders = Order::where('user_id', $request->user_id)->first();
        $date = date('Y-m-d', time());
        $order->date = $date;
        $result = $order->save();
        if ($result){
            return ["result"=>"order added",
                 "id" => $order->id
                ];
            }
        else{
            return ["result"=>"order not added"];
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
        $result = Order::find($id);
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
        $order = Order::find($id);
        $products_id = explode(',' ,$request->products_id);
        $stored_products = "";
        for ($i = 0; $i < count($products_id); $i++){
            $stored_products = $stored_products.$products_id[$i]."\n";
        }
        $order->products_id = $stored_products;


        $quantities = explode(',' ,$request->quantities);
        $stored_quantities = "";
        for ($i = 0; $i < count($quantities); $i++){
            $stored_quantities = $stored_quantities.$quantities[$i]."\n";
        }
        $order->quantities = $stored_quantities;

        $prices = explode(',' ,$request->prices);
        $stored_prices = "";
        for ($i = 0; $i < count($prices); $i++){
            $stored_prices = $stored_prices.$prices[$i]."\n";
        }
        $order->prices = $stored_prices;


        $total_price = 0;
        for ($i = 0; $i < count($prices); $i++){
            $total_price = $total_price + (int)$quantities[$i] * (int)$prices[$i];
        }
        $order->total_price = $total_price;
        $order->user_id = $request->user_id;
        $date = date('Y-m-d', time());
        $order->date = $date;
        $result = $order->save();
        if ($result){
            return ["result"=>"order updated",
                "has_order" => "true",
                 "id" => $order->id
                ];
        }
        else{
            return ["result"=>"order not updated"];
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
        $order = Order::find($id);
        $now = time();
        $date = strtotime($order->date);
        $datediff = $now - $date;
        $actualdays = round($datediff / (60*60*24));
        if ($actualdays > 1){
            return ["result"=>"You can't cancel your order"];
        }
        else{
            $result = $order->delete();
            if ($result){
                return ["result"=>"order is deleted"];
            }
            else{
                return ["result"=>"order not deleted"];
            }

        }
     
    }
}
