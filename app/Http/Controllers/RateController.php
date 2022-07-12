<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rate;

class RateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $result = Rate::all();
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
        $rates = new Rate;
        $rates->product_id = $request->product_id;
        $rates->user_id = $request->user_id;
        $rates->rate = $request->rate;
        $rate = Rate::where('user_id', $request->user_id)->where('product_id',$request->product_id)->first();
        if ($rate == null){
            $result = $rates->save();
        
            if ($result){
                return ["result"=>"Rate added",
            "id" => $rate->id];
            }
            else{
                return ["result"=>"Rate not added"];
            }

        }
        else{
            return ["message"=>"You have already rated this product"];

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
        $result = Rate::find($id);
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
        $rates = Rate::find($id);
        $rates->product_id = $request->product_id;
        $rates->user_id = $request->user_id;
        $rates->rate = $request->rate;
        $result = $rates->save();
        if ($result){
            return ["result"=>"Rate updated"];
        }
        else{
            return ["result"=>"Rate not updated"];
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
        $rate = Rate::find($id);
        $result = $rate->delete();
        if ($result){
            return ["result"=>"Rate is deleted"];
        }
        else{
            return ["result"=>"Rate not deleted"];
        }
    }
}
