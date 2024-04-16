<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LikeModel extends Model
{
    use HasFactory;

    protected $table = 'like';
    protected $primaryKey = 'id';
    protected $fillable = ['foto_id', 'user_id', 'liker_name'];

    public function foto()
    {
        return $this->belongsTo(FotoModel::class, 'foto_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
