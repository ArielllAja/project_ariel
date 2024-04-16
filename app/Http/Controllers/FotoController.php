<?php

namespace App\Http\Controllers;

use App\Models\AlbumModel;
use App\Models\FotoModel;
use App\Models\LikeModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\File;

class FotoController extends Controller
{
    public function index()
    {
        $albums = AlbumModel::where('userId', auth()->id())->get();
        return view('dashboard.foto', ['albums' => $albums]);
    }

    public function postfoto(Request $request)
    {
        $validatedData = $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string|max:1000',
            'albumId' => 'required|exists:album,id',
            'lokasifoto' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $fotoPath = $request->file('lokasifoto')->store('public/fotos');
        $fotoUrl = URL::to('/').Storage::url($fotoPath);

        $foto = new FotoModel([
            'judul' => $validatedData['judul'],
            'deskripsi' => $validatedData['deskripsi'],
            'lokasifoto' => $fotoUrl,
            'userId' => auth()->id(),
            'albumId' => $validatedData['albumId'],
        ]);
        $foto->save();

        return redirect()->route('dashboard')->with('success', 'Foto berhasil ditambahkan!');
    }

    public function like($id)
    {
        $photo = FotoModel::find($id);
        if (!$photo) {
            return redirect()->back()->with('error', 'Foto tidak ditemukan.');
        }

        $userId = auth()->id();
        $existingLike = LikeModel::where('user_id', $userId)
                                ->where('foto_id', $photo->id)
                                ->first();

        if ($existingLike) {
            $existingLike->delete();
            session()->flash('success', 'Foto tidak disukai lagi.');
        } else {
        $like = new LikeModel([
            'foto_id' => $photo->id,
            'user_id' => $userId,
            'liker_name' => auth()->user()->name,
            ]);
            $like->save();
            session()->flash('success', 'Foto disukai!');
        }
        return redirect()->back();
    }
    public function delete($id)
    {
        $photo = FotoModel::find($id);

        if (!$photo) {
            return redirect()->back()->with('error', 'Foto tidak ditemukan.');
        }

        $photoPath = str_replace(URL::to('/'), '', $photo->lokasifoto);
        if (File::exists(public_path($photoPath))) {
            File::delete(public_path($photoPath));
        }

        $photo->delete();

        return redirect()->back()->with('success', 'Foto berhasil dihapus.');
    }

}
