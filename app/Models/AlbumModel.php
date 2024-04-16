<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AlbumModel extends Model
{
    use HasFactory;
    protected $table = 'album';
    protected $primaryKey = 'id';
    protected $fillable = [
        'namaAlbum',
        'deskripsi',
        'userId',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'userId');
    }
    public function foto()
    {
        return $this->hasMany(FotoModel::class, 'id');
    }
}
