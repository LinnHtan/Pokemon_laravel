<?php

namespace App\Http\Controllers;

use App\Models\Pokemon;
use App\Models\Rarity;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    //get all pokemon list
    public function pokemonList()
    {
        $pokemon = Pokemon::get();
        return response()->json($pokemon, 200);
    }

    //create pokemon
    public function pokemonCreate(Request $request)
    {
        $data = $this->pokemonData($request);
        if ($request->hasFile('image')) {
            $fileName = uniqid() . $request->file('image')->getClientOriginalName();
            $request->file('image')->storeAs('public', $fileName);
            $data['image'] = $fileName;
        }
        $response = Pokemon::create($data);
        return response()->json($response, 200);
    }

    //delete pokemon
    public function pokemonDelete($id)
    {
        $data = Pokemon::where('id', $id)->first();
        if (isset($data)) {
            Pokemon::where('id', $id)->delete();
            return response()->json(['status' => true, 'message' => 'delete success', 'deleteData' => $data]);
        }
        return response()->json(['status' => false, 'message' => 'There is no data']);
    }

    //detail pokemon
    public function pokemonDetail(Request $request)
    {
        $data = Pokemon::where('id', $request->id)->first();
        if (isset($data)) {
            return response()->json(['status' => true, 'rarityDetail' => $data]);
        }
        return response()->json(['status' => false, 'message' => 'There is no data']);
    }

    //update pokemon
    public function pokemonUpdate(Request $request)
    {
        $pokemonId = $request->id;
        $myId = Pokemon::where('id', $pokemonId)->first();
        if (isset($myId)) {
            $data = $this->pokemonData($request);

            if ($request->hasFile('image')) {
                $fileName = uniqid() . $request->file('image')->getClientOriginalName();
                $request->file('image')->storeAs('public', $fileName);
                $data['image'] = $fileName;
            }

            Pokemon::where('id', $pokemonId)->update($data);
            $response = Pokemon::where('id', $pokemonId)->first();
            return response()->json(['status' => true, 'message' => 'pokemon update success', 'pokemon' => $response], 200);
        }
        return response()->json(['status' => false, 'message' => 'There is no pokemon...'], 500);
    }

    //get all rarity list
    public function rarityList()
    {
        $rarity = Rarity::get();
        return response()->json($rarity, 200);
    }

    //create rarity
    public function rarityCreate(Request $request)
    {
        $data = $this->rarityData($request);
        $response = Rarity::create($data);
        return response()->json($response, 200);
    }

    //delete rarity
    public function rarityDelete($id)
    {
        $data = Rarity::where('id', $id)->first();
        if (isset($data)) {
            Rarity::where('id', $id)->delete();
            return response()->json(['status' => true, 'message' => 'delete success', 'deleteData' => $data], 200);
        }
        return response()->json(['status' => false, 'message' => 'There is no data'], 500);
    }

    //detail rarity
    public function rarityDetail(Request $request)
    {
        $data = Rarity::where('id', $request->id)->first();
        if (isset($data)) {
            return response()->json(['status' => true, 'rarityDetail' => $data], 200);
        }
        return response()->json(['status' => false, 'message' => 'There is no data'], 500);
    }

    //update rarity
    public function rarityUpdate(Request $request)
    {
        $rarityId = $request->id;
        $myId = Rarity::where('id', $rarityId)->first();
        if (isset($myId)) {
            $data = $this->rarityData($request);
            Rarity::where('id', $rarityId)->update($data);
            $response = Rarity::where('id', $rarityId)->first();
            return response()->json(['status' => true, 'message' => 'rarity update success', 'rarity' => $response], 200);
        }
        return response()->json(['status' => false, 'message' => 'There is no rarity...'], 500);
    }

    //pokemon filter
    public function filterPokemon(Request $request)
    {
        $pokemonQuery = Pokemon::query();
        if ($request->rarity) {
            $pokemonQuery->where('rarity', $request->rarity);
        }

        $pokemon = $pokemonQuery->get();
        return response()->json(['pokemon' => $pokemon]);
    }

    //search pokemon
    public function searchPokemon(Request $request)
    {
        $pokemonQuery = Pokemon::query();
        if ($request->keyword) {
            $pokemonQuery->where('name', 'like', '%' . $request->keyword . '%');
        }

        $pokemon = $pokemonQuery->get();
        return response()->json(['pokemon' => $pokemon]);
    }

    //rarity data
    private function rarityData($request)
    {
        return [
            'name' => $request->name,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }

    //pokemon data
    private function pokemonData($request)
    {
        return [
            'name' => $request->name,
            'rarity' => $request->rarity,
            'image' => $request->image,
            'price' => $request->price,
            'qty' => $request->qty,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }

}
