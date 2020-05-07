<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use Auth;

class UserController extends Controller
{
    function showUserView()
    {
        if (Auth::user()->id == 1) {
            return view('adminView');
        } else if (Auth::check()) {
            return view('userView');
        } else {
            return redirect('/');
        }
    }
    function confirmLogin()
    {
        if (Auth::check()) {
            $isLoggedin = true;
            return response()->json($isLoggedin);
        }
        $isLoggedin = false;
        return response()->json($isLoggedin);
    }
    function storeCoffee(Request $request)
    {
        if (Auth::check()) {
            $check = \App\Coffee::where("name", "$request->coffeeName")->get();
            if (sizeOf($check) == 0) {
                if ($request->coffeeName == "N/D" && $request->coffeeCity == "N/D" && $request->coffeeCountry == "N/D") {
                    $userMessage = "Your submission was cancelled. You need fill out the form below.";
                } else if ($request->file('file') == null) {
                    $coffee = new \App\Coffee;
                    $coffee->user_id = Auth::user()->id;
                    $coffee->name = $request->coffeeName;
                    $coffee->city = $request->coffeeCity;
                    $coffee->country = $request->coffeeCountry;
                    $coffee->reviewed = "no";
                    $coffee->picture = "default.jpeg";
                    $coffee->save();
                    $userMessage = "Your submission was completed successfully. We will review it before publishing.";
                } else {
                    $coffee = new \App\Coffee;
                    $coffee->user_id = Auth::user()->id;
                    $coffee->name = $request->coffeeName;
                    $coffee->city = $request->coffeeCity;
                    $coffee->country = $request->coffeeCountry;
                    $coffee->reviewed = "no";
                    $file = $request->file('file')->store('public');
                    $coffee->picture = basename($file);
                    $coffee->save();
                    $userMessage = "Your submission was completed successfully. We will review your contribution before publishing.";
                }
            } else {
                $userMessage = "Sorry, this coffee already exists on our database.";
            }
            return response()->json($userMessage);
        }
    }

    function getCoffeeToReview()
    {
        if (Auth::user()->id == 1) {
            $coffees = \App\Coffee::where('reviewed', 'no')->get();
            return response()->json($coffees);
        }
    }
    function updatedCoffee(Request $request)
    {
        if (Auth::user()->id == 1) {
            foreach ($request->reviewedCoffee as $id) {
                $coffee = \App\Coffee::find($id);
                $coffee->reviewed = 'yes';
                $coffee->save();
            }
            $reviews = \App\Coffee::where('reviewed', 'no')->get();
            error_log(sizeOf($reviews));
            if (sizeOf($reviews) == 0) {
                return response()->json("Revision made successfully. There is no coffee to be reviewed");
            }
            return response()->json("Revision made successfully. ");
        }
    }
    function deleteCoffeeDB(Request $request)
    {
        if (Auth::user()->id == 1) {
            foreach ($request->reviewedCoffee as $id) {
                \App\Coffee::destroy($id);
            }
            $reviews = \App\Coffee::where('reviewed', 'no')->get();
            error_log(sizeOf($reviews));
            if (sizeOf($reviews) == 0) {
                return response()->json("Selected coffees were deleted. There is no coffee to be reviewed");
            }
            return response()->json("Selected coffees were deleted.");
        }
    }
    function checkIds(Request $request)
    {
        $isUser = false;
        if (Auth::check()) {
            if (Auth::user()->id == $request->userId) {
                $isUser = true;
            }
        }
        return response()->json($isUser);
    }
}
