<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\Datatables\Html\Builder;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Session;
use App\Berita;

class BeritaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request,Builder $htmlBuilder)
    {
        //
    if ($request->ajax()) {
            $beritas = Berita::with('categori');
            return Datatables::of($beritas)->addColumn('action', function($beritas){
            return view('datatable._action',[
                'model'     => $beritas,
                'form_url'  => route('beritas.destroy', $beritas->id),
                'edit_url' => route('beritas.edit', $beritas->id),
                'confirm_message'=>'Yakin mau menghapus : '.$beritas->judul.' ?'
            
                ]);
        })->make(true);
    }
    $html = $htmlBuilder
            ->addColumn(['data'=>'judul','name'=>'judul','title'=>'Judul'])
            ->addColumn(['data'=>'deskripsi','name'=>'deskripsi','title'=>'Deskripsi'])
            ->addColumn(['data'=>'categori.categori','name'=>'categori.categori','title'=>'Categori'])
            ->addColumn(['data'=>'action', 'name'=>'action', 'title'=>'', 'orderable'=>false,
                'searchable'=>false]);
        return view('beritas.index')->with(compact('html'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('beritas.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        /* yang  sebelum dibuat request */
        $this->validate($request,[
            'judul' =>'required|unique:beritas,judul',
            'categori_id'=>'required|exists:categoris,id',
            'deskripsi'=>'required|string',
            'cover'=>'image|max:10000'
            ]); 
        $berita = Berita::create($request->except('cover'));
        //isi file cover jika ada cover yang di upload
        if($request->hasFile('cover')) {
            //mengambil file yang di upload
            $uploded_cover = $request->file('cover');
            //mengambil extensi file
            $extension = $uploded_cover->getClientOriginalExtension();
            //membuat nama file random berikut extensi
            $filename=md5(time()) .'.'. $extension;
            //menyimpan cover ke folder public/img
            $destinationPath = public_path() . DIRECTORY_SEPARATOR .'img';
            $uploded_cover->move($destinationPath,$filename);
            //mengisi field cover di book dengan file name yang baru di buat
            $berita->cover = $filename;
            $berita->save();
        }
        Session::flash("flash_notification", [
            "level"=>"success",
            "message"=>"Berhasil menyimpan $berita->judul"
            ]);
        return redirect()->route('beritas.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
