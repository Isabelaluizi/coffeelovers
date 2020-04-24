<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CoffeeController extends Controller
{
    function getCoffeeDB () {
        $coffees=\App\Coffee::orderBy('name')->get();
        return response()->json($coffees);
    }
}
