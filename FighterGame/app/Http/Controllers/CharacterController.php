<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Character;
class CharacterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $characters = Auth::user()->character;
        return view('character.index', ['characters' => $characters]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('character.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $character = Character::findOrFail($id);

        if (Auth::id() !== $character->user_id) {
        abort(403, 'Nincs jogosultságod megtekinteni ezt a karaktert!');
        }


        $matches = $character->contest;
        $PlaceNames = $matches->map(function ($match) {
            return $match->place->name;
        });
        $OpponentNames = $matches->map(function ($match) use ($character) {
            $opponent = $match->character->firstWhere('id', '!=', $character->id);
            return $opponent->name;
        });
        return view('character.show', ['character' => $character,'PlaceNames' => $PlaceNames, 'OpponentNames' => $OpponentNames]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return view('character.edit');
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
        return redirect()->route('characters');
    }
}
