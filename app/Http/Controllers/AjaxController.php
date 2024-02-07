<?php

namespace App\Http\Controllers;

use App\Models\Pokemon;
use Illuminate\Http\Request;

class AjaxController extends Controller
{
    //return pokemon
    public function myList(Request $request)
    {
        if ($request->status == 'high') {
            $data = Pokemon::orderBy('price', 'desc')->get();
        } else {
            $data = Pokemon::orderBy('price', 'asc')->get();
        }
        return $data;
    }
}
