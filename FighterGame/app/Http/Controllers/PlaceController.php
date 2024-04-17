<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\Place;


class PlaceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $places = Place::all();
        if (Auth::user()->admin !== 1) {
            abort(403, 'Nincs jogosultságod a tartalom megtekintésére!');
        }

        return view('place.index', ['places' => $places]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (Auth::user()->admin !== 1) {
            abort(403, 'Nincs jogosultságod a tartalom megtekintésére!');
        }

        return view('place.create');
    }

    /**
     * Store a newly created resource in storage.
     */


public function store(Request $request)
{
    if (Auth::user()->admin !== 1) {
        abort(403, 'Nincs jogosultságod a tartalom megtekintésére!');
    }

    $validated = $request->validate([
        'name' => 'required|string',
        'imagename' => 'required|image',
    ], [
        'name.required' => 'A név megadása kötelező!',
        'name.string' => 'A név csak szöveg lehet!',
        'imagename.required' => 'A kép megadása kötelező!',
        'imagename.image' => 'A kép formátuma nem megfelelő!',
    ]);

    if ($request->hasFile('imagename')) {
        $file = $request->file('imagename');
        $fname = $file->hashName();
        Storage::disk('public')->put('images/' . $fname, $file->get());
        $validated['imagename'] = $fname;
    }

    $place = new Place();
    $place->name = $validated['name'];
    $place->imagename = $validated['imagename'];
    $place->save();

    return redirect()->route('places.index');
}



    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        if (Auth::user()->admin !== 1) {
            abort(403, 'Nincs jogosultságod a tartalom megtekintésére!');
        }
        return view('place.edit', ['place' => Place::find($id)]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'imagename' => 'required|image',
        ], [
            'name.required' => 'A név megadása kötelező!',
            'name.string' => 'A név csak szöveg lehet!',
            'imagename.required' => 'A kép megadása kötelező!',
            'imagename.image' => 'A kép formátuma nem megfelelő!',
        ]);

        if ($request->hasFile('imagename')) {
            $file = $request->file('imagename');
            $fname = $file->hashName();
            Storage::disk('public')->put('images/' . $fname, $file->get());
            $validated['imagename'] = $fname;
        }

        $place = Place::find($id);
        $place->name = $validated['name'];
        $place->imagename = $validated['imagename'];
        $place->save();

        return redirect()->route('places.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if (Auth::user()->admin !== 1) {
            abort(403, 'Nincs jogosultságod a tartalom megtekintésére!');
        }
        Storage::disk('public')->delete('images/' . Place::find($id)->imagename);
        Place::destroy($id);
        return redirect()->route('places.index');
    }
}
