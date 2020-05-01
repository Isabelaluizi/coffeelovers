<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;

class CommentController extends Controller
{
    function storeCommentDB (Request $request) {
        if($request->name==null && $request->stars==null){
            return response()->json("Name and Comment are required");
        }
        if($request->name == null){
            return response()->json("Name is required");
        }
        if($request->comment ==null){
            return response()->json("Comment is required");
        }
        if($request->stars==0){
            return response()->json("You need to rate this coffee from 0.5 to 5");
        }
        $comment = new \App\Comment;
        $comment->user_id = Auth::user()->id;
        $comment->nickname = $request->name;
        $comment->coffee_id = $request->coffeeId;
        $comment->content = $request->comment;
        $comment->stars = $request->stars;
        $comment->save();
        return response()->json("ok");
    }

    function getCommentCoffee (Request $request) {
        $comments=\App\Coffee::find($request->coffeeId)->comments;
        return response()->json($comments);
    }
}
