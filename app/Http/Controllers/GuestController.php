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
            ->addColumn('cover', function($berita){
              return '<img src="/img/'.$berita->cover. '" height="100px" width="100px" >';
            })
            ->addColumn('spoiler', function($berita){
              return '<a href="'.route('guests.show',$berita->id).'">'.$berita->spoiler.'</a>';
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
              ->addColumn(['data'=>'spoiler','name'=>'spoiler','title'=>'Spoiler','orderable'=>false,'searchable'=>false])
              ->addColumn(['data'=>'categori.categori','name'=>'categori.categori','title'=>'Categori'])
              ->addColumn(['data'=>'action','name'=>'action','title'=>'','orderable'=>false,
                           'searchable'=>false]);
              return view('guest.index')->with(compact('html'));
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $berita = Berita::find($id);
        return view('guest.show',compact('berita'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}


