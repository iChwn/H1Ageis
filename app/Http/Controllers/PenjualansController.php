<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Penjualan;
use Yajra\Datatables\Datatables;
use DB;

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

    public function penjualandatatable()
    {
        return view ('Penjualan.indexjs');
    }

    public function penjualanlist()
    {
        return Datatables::of(Penjualan::all())
        ->addColumn('test',function($this_model){
            return '<a class="btn btn-primary btn-sm" href="penjualan/'.$this_model->id.'/edit">Edit</a>';
        })
        ->addColumn('action',function($this_model){
            return '<a class="btn btn-primary btn-sm" href="penjualan/delete/'.$this_model->id.'">Delete</a>';
        })
        ->make(true);
    }

    //Chart
    public function selectData($year,$month)
    {
        $calendar = cal_days_in_month(CAL_GREGORIAN, $month, $year);
        $cat_data = array();
        for($i=1;$i<=$calendar;$i++){
            $tgl = $year.'-'.$month.'-'.($i+00);
            $cat_data[] = $this->countByDay($year,$month,$tgl);
        }
        return $cat_data;
    }
    
    public function countByDay($year,$month,$tgl)
    {
        $this_ = Penjualan::whereYear('tanggal',$year)->whereMonth('tanggal',$month)->where('tanggal',$tgl)->count();
        return $this_;
    }
}
