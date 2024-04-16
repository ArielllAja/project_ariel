<?php

namespace App\Http\Controllers;

use App\Models\CommentModel;
use App\Models\FotoModel;
use App\Models\LikeModel;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index()
    {
        $photos = FotoModel::all();
        $likesCounts = [];
        $commentsCounts = [];
        foreach ($photos as $photo) {
            $likesCounts[$photo->id] = LikeModel::where('foto_id', $photo->id)->count();
            $commentsCounts[$photo->id] = CommentModel::where('foto_id', $photo->id)->count();
        }
        return view('index', ['photos' => $photos, 'likesCounts' => $likesCounts, 'commentsCounts' => $commentsCounts]);
    }


}
