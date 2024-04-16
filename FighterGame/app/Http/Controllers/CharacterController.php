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
        $request->validate([
            'name' => 'required|string',
            'defence' => 'required|integer|min:0|max:3',
            'strength' => 'required|integer|min:0|max:20',
            'accuracy' => 'required|integer|min:0|max:20',
            'magic' => 'required|integer|min:0|max:20',

        ], [
            'name.required' => 'A név megadása kötelező!',
            'defence.required' => 'A védelem megadása kötelező!',
            'defence.integer' => 'A védelemnek egész számnak kell lennie!',
            'defence.min' => 'A védelem legalább 0 lehet!',
            'defence.max' => 'A védelem legfeljebb 3 lehet!',
            'strength.required' => 'Az erő megadása kötelező!',
            'strength.integer' => 'Az erőnek egész számnak kell lennie!',
            'strength.min' => 'Az erő legalább 0 lehet!',
            'strength.max' => 'Az erő legfeljebb 20 lehet!',
            'accuracy.required' => 'A pontosság megadása kötelező!',
            'accuracy.integer' => 'A pontosságnak egész számnak kell lennie!',
            'accuracy.min' => 'A pontosság legalább 0 lehet!',
            'accuracy.max' => 'A pontosság legfeljebb 20 lehet!',
            'magic.required' => 'A varázserő megadása kötelező!',
            'magic.integer' => 'A varázserőnek egész számnak kell lennie!',
            'magic.min' => 'A varázserő legalább 0 lehet!',
            'magic.max' => 'A varázserő legfeljebb 20 lehet!',

        ]);

        $totalStats = $request->defence + $request->strength + $request->accuracy + $request->magic;
        if ($totalStats > 20) {
            return redirect()->back()->withInput()->withErrors(['totalStats' => 'A karakter tulajdonságainak összege nem lehet nagyobb, mint 20!']);
        }
        $character = new Character();
        $character->name = $request->name;
        if ($request->has('enemy')) {
            $character->enemy = true;
        } else {
            $character->enemy = false;
        }
        $character->defence = $request->defence;
        $character->strength = $request->strength;
        $character->accuracy = $request->accuracy;
        $character->magic = $request->magic;
        $character->user_id = Auth::id();
        $character->save();
        return redirect()->route('characters');

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
        return view('character.show', ['character' => $character, 'PlaceNames' => $PlaceNames, 'OpponentNames' => $OpponentNames]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $character = Character::findOrFail($id);

        if (Auth::id() !== $character->user_id) {
            abort(403, 'Nincs jogosultságod szerkeszteni ezt a karaktert!');
        }

        return view('character.edit', ['character' => $character]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|string',
            'defence' => 'required|integer|min:0|max:3',
            'strength' => 'required|integer|min:0|max:20',
            'accuracy' => 'required|integer|min:0|max:20',
            'magic' => 'required|integer|min:0|max:20',

        ], [
            'name.required' => 'A név megadása kötelező!',
            'defence.required' => 'A védelem megadása kötelező!',
            'defence.integer' => 'A védelemnek egész számnak kell lennie!',
            'defence.min' => 'A védelem legalább 0 lehet!',
            'defence.max' => 'A védelem legfeljebb 3 lehet!',
            'strength.required' => 'Az erő megadása kötelező!',
            'strength.integer' => 'Az erőnek egész számnak kell lennie!',
            'strength.min' => 'Az erő legalább 0 lehet!',
            'strength.max' => 'Az erő legfeljebb 20 lehet!',
            'accuracy.required' => 'A pontosság megadása kötelező!',
            'accuracy.integer' => 'A pontosságnak egész számnak kell lennie!',
            'accuracy.min' => 'A pontosság legalább 0 lehet!',
            'accuracy.max' => 'A pontosság legfeljebb 20 lehet!',
            'magic.required' => 'A varázserő megadása kötelező!',
            'magic.integer' => 'A varázserőnek egész számnak kell lennie!',
            'magic.min' => 'A varázserő legalább 0 lehet!',
            'magic.max' => 'A varázserő legfeljebb 20 lehet!',

        ]);

        $totalStats = $request->defence + $request->strength + $request->accuracy + $request->magic;
        if ($totalStats > 20) {
            return redirect()->back()->withInput()->withErrors(['totalStats' => 'A karakter tulajdonságainak összege nem lehet nagyobb, mint 20!']);
        }
        $character = Character::find($id);
        $character->name = $request->name;
        if ($request->has('enemy')) {
            $character->enemy = true;
        } else {
            $character->enemy = false;
        }
        $character->defence = $request->defence;
        $character->strength = $request->strength;
        $character->accuracy = $request->accuracy;
        $character->magic = $request->magic;
        $character->save();

        return redirect()->route('characters.show', ['id' => $id]);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return redirect()->route('characters');
    }
}
