<?php

namespace App\Http\Controllers;

use App\Models\Rarity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RarityController extends Controller
{
    //rarity home
    public function rarityPage()
    {
        return view('rarity.rarity');
    }

    //create rarity
    public function create(Request $request)
    {
        $this->rarityValidation($request);
        $data = $this->rarityData($request);
        Rarity::create($data);
        return back()->with(['CreateSuccess' => 'Rarity Create Success ...']);
    }

    //private data
    private function rarityData($request)
    {
        return [
            "name" => $request->name,
        ];
    }

    //private data
    private function rarityValidation($request)
    {
        $validation = [
            'name' => 'required',
        ];
        Validator::make($request->all(), $validation)->validate();
    }

}
