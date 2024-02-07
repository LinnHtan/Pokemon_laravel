<?php

namespace App\Http\Controllers;

use App\Models\Pokemon;
use App\Models\Rarity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class PokemonController extends Controller
{

    //home page
    public function home()
    {
        $post = Pokemon::select('pokemon.*', 'rarities.name as rarity_name')
            ->leftJoin('rarities', 'pokemon.rarity', 'rarities.id')
            ->when(request('searchKey'), function ($query) {
                $key = request('searchKey');
                $query->where('pokemon.name', 'like', "%" . $key . "%");
            })->get();
        $rarity = Rarity::get();
        return view('home.home', compact('post', 'rarity'));
    }

    //for filter
    public function filter($id)
    {
        $post = Pokemon::select('pokemon.*', 'rarities.name as rarity_name', 'pokemon.rarity as rarity_id')
            ->leftJoin('rarities', 'pokemon.rarity', 'rarities.id')
            ->where('pokemon.rarity', $id)
            ->when(request('searchKey'), function ($query) {
                $key = request('searchKey');
                $query->where('pokemon.name', 'like', "%" . $key . "%");
            })->get();
        $rarity = Rarity::get();
        return view('home.home', compact('post', 'rarity'));
    }

    //direct pokemon home page
    public function createPage()
    {
        $pokemon = Pokemon::get();
        $rarity = Rarity::get();
        return view('pokemon.create', compact('pokemon', 'rarity'));
    }

    //create pokemon
    public function create(Request $request)
    {
        $this->pokemonValidation($request, 'create');
        $data = $this->pokemonData($request);

        if ($request->hasFile('image')) {
            $fileName = uniqid() . $request->file('image')->getClientOriginalName();
            $request->file('image')->storeAs('public', $fileName);
            $data['image'] = $fileName;
        }
        Pokemon::create($data);
        return back()->with(['CreateSuccess' => 'Pokemon Create Success ...']);

    }

    //delete pokemon
    public function delete($id)
    {
        Pokemon::where('id', $id)->delete();
        return back()->with(['deleteSuccess' => 'Pokemon Delete Success...']);
    }
    //editPage pokemon
    public function editPage($id)
    {
        $pokemon = Pokemon::where('id', $id)->first();
        $rarity = Rarity::get();
        return view('pokemon.edit', compact('pokemon', 'rarity'));
    }

    //update pokemon
    public function update($id, Request $request)
    {
        $this->pokemonValidation($request, 'update', $id);
        $data = $this->pokemonData($request);
        $oldImage = Pokemon::where('id', $id)->first();
        $oldImage = $oldImage->image;
        if ($request->hasFile('image')) {

            if ($oldImage != null) {
                Storage::delete('public/' . $oldImage);
            }
            $fileName = uniqid() . $request->file('image')->getClientOriginalName();
            $request->file('image')->storeAs('public', $fileName);
            $data['image'] = $fileName;
        } else {
            $data['image'] = $oldImage;
        }

        Pokemon::where('id', $request->id)->update($data);
        return redirect()->route('pokemon#createPage');
    }

    //private data of pokemon data
    private function pokemonData($request)
    {
        return [
            'name' => $request->name,
            'image' => $request->image,
            'price' => $request->price,
            'qty' => $request->qty,
            'rarity' => $request->rarity,
        ];
    }

    //private data of pokemon validation
    private function pokemonValidation($request, $status)
    {
        $validation = [
            'name' => 'required',
            'price' => 'required',
            'qty' => 'required',
            'rarity' => 'required',
        ];
        $validation['image'] = $status == "create" ? 'required|mimes:jpg,jpeg,png,webp|file' : 'mimes:jpg,jpeg,png,webp|file';
        Validator::make($request->all(), $validation)->validate();
    }

}
