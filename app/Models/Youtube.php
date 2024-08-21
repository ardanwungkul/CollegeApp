<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Youtube extends Model
{
    use HasFactory;
    public function user()
    {
        return $this->belongsToMany(User::class, 'pivot_user_youtube', 'youtube_id', 'user_id');
    }
}
