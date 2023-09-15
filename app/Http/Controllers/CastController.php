<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CastController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $casts = DB::table('cast')->get();
        return view('cast.index', compact('casts'));    
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('cast.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'nama'  => 'required',
            'umur'  => 'required',
            'bio'   => 'required',
        ]);

        $query = DB::table('cast')->insert([
            'nama'  => $request['nama'],
            'umur'  => $request['umur'],
            'bio'   => $request['bio'],
        ]);

        return redirect('/cast');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        // SELECT * FROM cast where id = $id
        $cast = DB::table('cast')->where('id', $id)->get();
        return view('cast.show', compact('cast'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $cast = DB::table('cast')->where('id', $id)->get();
        return view('cast.edit', compact('cast'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $request->validate([
            'nama'  => 'required|unique:cast,nama',
            'umur'  => 'required|numeric',
            'bio'   => 'required|min:10|max:200',
        ]);

        $query = DB::table('cast')->where('id', $id)->update([
        // 'field yang ada di table' => $request['nameyang di kirim dari form']
            'nama' => $request['nama'],
            'umur' => $request['umur'],
            'bio'  => $request['bio'],
        ]);

        return redirect()->route('cast.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $query = DB::table('cast')->where('id', $id)->delete();
        return redirect()->route('cast.index');
    }
}
