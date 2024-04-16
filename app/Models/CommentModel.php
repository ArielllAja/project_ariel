<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommentModel extends Model
{
    protected $table = 'comments';
    protected $primaryKey = 'id';
    protected $fillable = ['user_id','commenter_name', 'comment', 'foto_id'];

    public function foto()
    {
        return $this->belongsTo(FotoModel::class, 'foto_id');
    }
}
