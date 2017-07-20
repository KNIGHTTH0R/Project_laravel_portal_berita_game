<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Yajra\Datatables\Html\Builder;
use Yajra\Datatables\Datatables;
use App\Berita;
use Laratrust\LaratrustFacade as Laratrust;

class GuestController extends Controller
{
    public function index(Request $request, Builder $htmlBuilder)
    {
    	if ($request->ajax())
    	{
    		$berita = Berita::with('categori');
    		return Datatables::of($berita)
    		->addColumn('cover', function($beritas){
              return '<img src="/img/'.$beritas->cover. '" height="100px" width="100px">';
            })
    		->addColumn('stock',function($berita){
            return $berita->stock;
            })
                ->addColumn('action',function($berita){                    
    			if (Laratrust::hasRole('admin')) return '';
    			/* return '<a class="btn btn-xs btn-primary" 
    					href=" '.route('guest.beritas.borrow',$berita->id).' ">
                        <i class="fa fa-btn fa-check-square-o"></i> Pinjam</a>'; */
    		})->make(true);
    	}

    	$html = $htmlBuilder

    		  ->addColumn(['data'=>'cover','name'=>'cover','title'=>'Cover'])
    		  ->addColumn(['data'=>'judul','name'=>'judul','title'=>'Judul'])
              ->addColumn(['data'=>'deskripsi','name'=>'deskripsi','title'=>'Deskripsi','orderable'=>false,'searchable'=>false])
    		  ->addColumn(['data'=>'categori.categori','name'=>'categori.categori','title'=>'Categori'])
    		  ->addColumn(['data'=>'action','name'=>'action','title'=>'','orderable'=>false,
    		  			   'searchable'=>false]);
    		  return view('guest.index')->with(compact('html'));
    }
}
