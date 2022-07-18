<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'body','user_id'
    ];

    public function author(){
        return $this->belongsTo(User::class,'user_id');
    }

    public function scopeUserPost($query,$user)
    {
        return $query->where('user_id',$user)->orderBy('id','desc');
    }
}
