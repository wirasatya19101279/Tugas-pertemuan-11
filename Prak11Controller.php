<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\kategori;
use App\produks;

class Prak11Controller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //menampilka seluruh dara di produk
        $KData = produks::get();
        $JRek = produks::count();
        
        return view('praktikum11.index',compact('KData','JRek'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //menampilkan form untuk menambahkan data produk baru
        $DKat = kategori::get();

        return view('praktikum11.create',compact('DKat'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //membuat validasi data
        $aturan = [
            'txProduk'=>'required',
            'txHargaBeli'=>'required|numeric',
            'txHargaJual'=>'required|numeric',
            'txStok'=>'required|numeric',
            'txKat'=>'required|numeric',
        ];
        $msg = [
             'required'=>'wajib diisi',
             'numeric'=>'diisi dengan data angka',
        ];
        $this->validate($request,$aturan,$msg);
        
        //menambahkan data produk baru
        produks::create([
            'namaproduk'=>$request->txProduk,
            'harga_beli'=>$request->txHargaBeli,
            'harga_jual'=>$request->txHargaJual,
            'qty'=>$request->txStok,
            'id_kat'=>$request->txKat,
        ]);
        return redirect()->route('prak11.index'); 
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //menampilkan data berdasarkan pencarian
        $kreteria = "%".$id."%";
        $KData = produks::where('namaproduk','like',$kreteria)->get();
        $JRek = produks::where('namaproduk','like',$kreteria)->count();
        return view('praktikum11.index', compact('KData','JRek'));

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
