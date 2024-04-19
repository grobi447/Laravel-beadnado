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

        if ($characters->find($request->character_id)->admin) {
            $enemy = $characters->where('enemy', true)->random();
        } else {
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

        return view('match.show', ['place' => $place, 'match' => $match]);
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
    public function update(string $id, Request $request)
    {
        $match = Contest::find($id);
        $att = $match->character[0];
        $deff = $match->character[1];
        $action = $request->input('action');
        //attacker attack
        if ($action == 'melee') {
            $new_hp = $deff->pivot->hero_hp - ($att->strength * 0.7 + $att->accuracy * 0.1 + $att->magic * 0.1) - $deff->defence;
        } else if ($action == 'ranged') {
            $new_hp = $deff->pivot->hero_hp - ($att->strength * 0.1 + $att->accuracy * 0.7 + $att->magic * 0.1) - $deff->defence;
        } else {
            $new_hp = $deff->pivot->hero_hp - ($att->strength * 0.1 + $att->accuracy * 0.1 + $att->magic * 0.7) - $deff->defence;
        }

        $att->pivot->enemy_hp = $new_hp;
        $deff->pivot->hero_hp = $new_hp;
        $att->pivot->save();
        $deff->pivot->save();
        if ($new_hp <= 0) {
            $deff->pivot->hero_hp = 0;
            $att->pivot->enemy_hp = 0;
            $deff->pivot->save();
            $att->pivot->save();
            $match->win = 1;
            $match->save();
        } else {
            //deffender attack
            $actions = ['melee', 'ranged', 'magic'];
            $enemyAction = $actions[array_rand($actions)];
            if ($enemyAction == 'melee') {
                $new_hp2 = $att->pivot->hero_hp - ($deff->strength * 0.7 + $deff->accuracy * 0.1 + $deff->magic * 0.1) - $att->defence;
            } else if ($enemyAction == 'ranged') {
                $new_hp2 = $att->pivot->hero_hp - ($deff->strength * 0.1 + $deff->accuracy * 0.7 + $deff->magic * 0.1) - $att->defence;
            } else {
                $new_hp2 = $att->pivot->hero_hp - ($deff->strength * 0.1 + $deff->accuracy * 0.1 + $deff->magic * 0.7) - $att->defence;
            }
            $att->pivot->hero_hp = $new_hp2;
            $deff->pivot->enemy_hp = $new_hp2;
            $att->pivot->save();
            $deff->pivot->save();
            if ($new_hp2 <= 0) {
                $att->pivot->hero_hp = 0;
                $deff->pivot->enemy_hp = 0;
                $att->pivot->save();
                $deff->pivot->save();
                $match->win = 0;
                $match->save();
            }
        }

      return redirect()->route('matches.show', ['id' => $match->id]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
