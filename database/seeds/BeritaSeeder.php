<?php

use Illuminate\Database\Seeder;
use App\Categori;
use App\Berita;
use App\User;

class BeritaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Sample categori
        $categori1 = Categori::create(['categori'=>'RPG']);
        $categori2 = Categori::create(['categori'=>'FPS']);
        $categori3 = Categori::create(['Categori'=>'RACING']);

        //sample berita
        $berita1 = Berita::create(['judul'=>'Legend of Zenonia','deskripsi'=>'Kisah Petualangan','categori_id'=>$categori1->id]);
        $berita2 = Berita::create(['judul'=>'Battlefiled','deskripsi'=>'Perang dunia ke 1','categori_id'=>$categori2->id]);
        $berita3 = Berita::create(['judul'=>'Asphalt Runner','deskripsi'=>'Game Balapan Mobil Terbaru','categori_id'=>$categori3->id]);
        $berita4 = Berita::create(['judul'=>'COD MWII','deskripsi'=>'Perang dunia ke 2','categori_id'=>$categori3->id]);

        //Sempel Peminjaman Buku
  /* minjam      $member = User::where('email','member@gmail.com')->first();
        BorrowLog::create(['user_id'=>$member->id,'berita_id'=>$berita1->id,'is_returned'=> 0]);
        BorrowLog::create(['user_id'=>$member->id,'berita_id'=>$berita2->id,'is_returned'=> 0]);
        BorrowLog::create(['user_id'=>$member->id,'berita_id'=>$berita3->id,'is_returned'=> 1]);
  */
    }
}
