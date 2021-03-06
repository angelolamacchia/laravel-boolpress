<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public $fillable = ['name', 'slug'];

    public function posts() {
        return $this->hasMany('App\Posts');
    }
}
