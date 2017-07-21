<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\Datatables\Html\Builder;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Session;
use App\Berita;
use Illuminate\Support\Facades\File;
use App\Http\Requests\StoreBeritaRequest;
use App\Http\Requests\UpdateBeritaRequest;

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
            return Datatables::of($beritas)
            ->addColumn('cover', function($beritas){
                return '<img src="/img/'.$beritas->cover. '" height="100px" width="100px">';
            })
            ->addColumn('action', function($beritas){
            return view('datatable._action',[
                'model'     => $beritas,
                'form_url'  => route('beritas.destroy', $beritas->id),
                'edit_url' => route('beritas.edit', $beritas->id),
                'confirm_message'=>'Yakin mau menghapus : '.$beritas->judul.' ?'
            
                ]);
        })->make(true);
    }
    $html = $htmlBuilder
            ->addColumn(['data'=>'cover','name'=>'cover','title'=>'Cover'])
            ->addColumn(['data'=>'judul','name'=>'judul','title'=>'Judul'])
            ->addColumn(['data'=>'spoiler','name'=>'spoiler','title'=>'Spoiler'])
           // ->addColumn(['data'=>'deskripsi','name'=>'deskripsi','title'=>'Deskripsi'])
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
    public function store(StoreBeritaRequest $request)
    {
        
        /* yang  sebelum dibuat request 
        $this->validate($request,[
            'judul' =>'required|unique:beritas,judul',
            'categori_id'=>'required|exists:categoris,id',
            'deskripsi'=>'required|string',
            'cover'=>'image|max:10000'
            ]); */
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
            //mengisi field cover di berita dengan file name yang baru di buat
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
        $berita =Berita::find($id);
        return view('beritas.edit')->with(compact('berita'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateBeritaRequest $request, $id)
    {
        //
         

        $berita = Berita::find($id);
        if (!$berita->update($request->all())) return redirect()->back();

        //isi file cover jika ada cover yang di upload

        if($request->hasFile('cover')) {
            //mengambil cover yang di upload berikut extension
            $filename=null;
            $uploded_cover = $request->file('cover');
            $extension = $uploded_cover->getClientOriginalExtension();
            //membuat nama file random berikut extensi
            $filename=md5(time()) .'.'. $extension;
            $destinationPath = public_path() . DIRECTORY_SEPARATOR .'img';
            
            //menyimpan cover ke folder public/img
            
            $uploded_cover->move($destinationPath,$filename);

            //hapus cover lama
            if($berita->cover) {
                $old_cover=$berita->cover;
                $filepath = public_path() . DIRECTORY_SEPARATOR .'img' 
                . DIRECTORY_SEPARATOR .$berita->cover;

                try{
                 File::delete($filepath);
                }catch (FileNotFoundException $e){
                    //file sudah dihapus/tidak ada
                }
            }
            //ganti field cover dengan cover baru
            $berita->cover=$filename;
            $berita->save();

        }

        Session::flash("flash_notification", [
            "level"=>"success",
            "message"=>"Berhasil menyimpan $berita->judul"
            ]);
        return redirect()->route('beritas.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {   
        $berita = Berita::find($id);
        $cover =$berita->cover;
        if (!$berita->delete()) return redirect()->back();
        //hapus cover lama, jika ada
        if($cover)
        {
            $old_cover = $berita->cover;
            $filepath = public_path().DIRECTORY_SEPARATOR.'img'.DIRECTORY_SEPARATOR.$berita->cover;
            try {
                File::delete($filepath);
            } catch (FileNotFoundException $e) {
                //file sudah dihapuys tidak ada
            }
        }


        Session::flash("flash_notification",[
            "level"=>"success",
            "message"=>"Buku $berita->judul berhasil di hapus"
            ]);
        return redirect()->route('beritas.index');
    }
}
