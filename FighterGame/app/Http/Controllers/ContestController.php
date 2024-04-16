<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Character;
class ContestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('match.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($id)
    {
        $character = Character::findOrFail($id);

        if (Auth::id() !== $character->user_id) {
        abort(403, 'Nincs jogosultságod meccset létrehozni ezzel a karakterrel');
        }

        return view('match.create');
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
        return view('match.show');
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
