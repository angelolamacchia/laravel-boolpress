<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = ['title', 'message', 'slug', 'user_id'];

    //1 utente ha + post
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
