<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Film;
use App\Models\Cast;
use App\Models\Peran;




class PeranController extends Controller
{
    //
    public function create(Film $film)
    {
        $casts = Cast::select('id', 'nama')->get();
        return view('peran.create', compact('film', 'casts'));
    }

    public function store(Film $film, Request $request)
    {
        $request->validate([
            'cast_id' => 'required',
            'nama' => 'required',
        ]);

        $peran = new Peran;
        $peran->film_id = $film->id;
        $peran->cast_id = $request->cast_id;
        $peran->nama = $request->nama;
        $peran->save();

        return redirect()->route('film.show', $film->id);
    }
}
