<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $result = Comment::all();
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
        $comment = new Comment;
        $comment->product_id = $request->product_id;
        $comment->user_id = $request->user_id;
        $comment->comment = $request->comment;
        $result = $comment->save();
        if ($result){
                return ["result"=>"Comment added",
            "id" => $comment->id];
        }
        else{

            return ["result"=>"Comment not added"];
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
        $result = Comment::find($id);
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
        $comment = Comment::find($id);
        $comment->product_id = $request->product_id;
        $comment->user_id = $request->user_id;
        $comment->comment = $request->comment;
        $result = $comment->save();
        if ($result){
            return ["result"=>"Comment updated"];
        }
        else{
            return ["result"=>"Comment not updated"];
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
        $comment = Comment::find($id);
        $result = $comment->delete();
        if ($result){
            return ["result"=>"Comment is deleted"];
        }
        else{
            return ["result"=>"Comment not deleted"];
        }
    }
}
