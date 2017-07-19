<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Berita extends Model
{
    protected $fillable=['judul','categori_id','deskripsi'];

    public function categori()
    {
    	return $this->belongsTo('App\Categori');
    }
}
