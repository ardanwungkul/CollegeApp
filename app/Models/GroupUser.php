<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GroupUser extends Model
{
    use HasFactory;
    public function user()
    {
        return $this->belongsToMany(User::class, 'pivot_group_user', 'group_id', 'user_id');
    }
}
