<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = ['title', 'content', 'slug', 'user_id', 'image'];

    //1 utente ha + post
    public function user() {
        return $this->belongsTo('App\User');
    }

    public function category() {
        return $this->belongsTo('App\Category');
    }

    // i tag hanno + post
    public function tags() {
        return $this->belongsToMany('App\Tag');
    }
}
