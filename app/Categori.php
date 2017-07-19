<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Categori extends Model
{
    protected $fillable=['categori'];

    public function berita()
    {
    	return $this->hasMany('App\Berita');
    }
}
