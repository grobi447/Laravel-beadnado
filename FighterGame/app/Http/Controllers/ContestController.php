<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Character;
use App\Models\Contest;
use App\Models\Place;
class ContestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $characters = Character::all();
        $places = Place::all();

        if($characters->find($request->character_id)->admin){
            $enemy = $characters->where('enemy', true)->random();
        }
        else{
            $enemy = $characters->where('enemy', false)->random();
        }

        $Match = new Contest();
        $history = [];
        $json = json_encode($history);
        $Match->user_id = Auth::id();
        $Match->place_id = $places->random()->id;
        $Match->win = null;
        $Match->history = $json;
        $Match->save();
        $Match->character()->attach($request->character_id);
        $Match->character()->attach($enemy->id);
        return redirect()->route('matches.show', ['id' => $Match->id]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $match = Contest::find($id);
        $place = Place::find($match->place_id);
        
        return view('match.show', ['place' => $place]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
