<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Penjualan;

class PenjualansController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Penjualan::all();
        return view ('Penjualan.index')->with(compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view ('Penjualan.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'tanggal' =>  'required',
            'penjualan'     =>  'required'
            ]);
        $data = new Penjualan();
        $data->penjualan = $request->penjualan;
        $data->tanggal = $request->tanggal;
        $data->tanggal = date('Y-m-d H:i:s');
        $data->save();
        return redirect()->route('penjualan.index')->with('alert-success','Berhasil Menambahkan Data!');
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
        $data = Penjualan::where('id',$id)->get();
        return view ('Penjualan.edit')->with(compact('data'));
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
        $data = Penjualan::where('id',$id)->first();
        $data->penjualan = $request->penjualan;
        $data->tanggal = $request->tanggal;
        $data->save();
        return redirect()->route('penjualan.index')->with('alert-success','Berhasil Menambahkan Data!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Penjualan::destroy($id);
        return redirect()->back()->with('alert-danger','Berhasil Menghapus Data!');
    }
}
