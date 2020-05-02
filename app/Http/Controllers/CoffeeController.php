<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;

class CoffeeController extends Controller
{
    function getCoffeeDB () {
        $coffees=\App\Coffee::where('reviewed', 'yes')->orderBy('name')->get();
        return response()->json($coffees);
    }
    function showCoffeeComment ($coffeeId) {
        $coffee=\App\Coffee::find($coffeeId);
        if($coffee!=null) {
            return view('coffeeComments',['coffee'=>$coffee]);
        }
        return redirect('/');
    }

}
