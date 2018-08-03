<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Config;
use App\User;
use App\Penjualan;

class AdminsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = User::all();
        return view('User.index')->with(compact('data'));
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

    public function test()
    {
        $bulan = 2;
        $tahun = 2018;
        $number = cal_days_in_month(CAL_GREGORIAN, $bulan, $tahun); // 31
       

        for ($i=1; $i <$number ; $i++) { 
            echo $i;
        }
         return $i;
    }

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
