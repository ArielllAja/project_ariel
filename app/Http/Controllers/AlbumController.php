<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\AlbumModel;
use Illuminate\Http\Request;

class AlbumController extends Controller
{
    public function index()
    {
        return view('dashboard.album');
    }

    public function post(Request $request)
    {

        $request->validate([
            'namaAlbum' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
        ]);

        AlbumModel::create([
            'namaAlbum' => $request->namaAlbum,
            'deskripsi' => $request->deskripsi,
            'userId' => auth()->id(),
        ]);

        return redirect()->route('dashboard')->with('success', 'Album berhasil dibuat.');
    }



}
