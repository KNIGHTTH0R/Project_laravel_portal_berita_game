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

    public static function boot()
    {
    	parent::boot();

    	self::deleting(function($categori){
    		//mengecek apakah categori mempunai berita
    		if($categori->beritas->count() > 1) {
    			//menyiapkan pesan error
    			$html = 'Categori tidak bisa dihapus karena memiliki berita : ';
    			$html = '<ul>';
    			foreach ($categori->beritas as $berita) {
    				$html = "<li>$berita->judul</li>";
    			}
    			$html .='</ul>';

    			Session::flash("flash_notification",[
    				"level"=>"danger",
    				"message"=>$html
    				]);
    			//membatalkan
    			return false;
    		}
    	});
    }
}
