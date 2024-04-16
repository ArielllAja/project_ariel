<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FotoModel extends Model
{
    use HasFactory;
    protected $table = 'foto';
    protected $primaryKey = 'id';
    protected $fillable = ['judul', 'deskripsi', 'lokasifoto', 'userId', 'albumId'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function likes()
    {
        return $this->hasMany(LikeModel::class, 'id');
    }
    public function comments()
    {
        return $this->hasMany(CommentModel::class, 'foto_id');
    }
    public function album()
    {
        return $this->belongsTo(AlbumModel::class, 'albumId');
    }
}
