<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Charts\SampleChart;
use App\Http\Controllers\Controller;
use App\Perhitungan;
use Yajra\Datatables\Datatables;

class ChartsController extends Controller
{
    public function chart()
    {
    	$this_data = [
    		$this->getByMonth('January'),
    		$this->getByMonth('February'),
    		$this->getByMonth('March'),
    		$this->getByMonth('April'),
    		$this->getByMonth('May'),
    		$this->getByMonth('June'),
    		$this->getByMonth('July'),
    		$this->getByMonth('August'),
    		$this->getByMonth('September'),
    		$this->getByMonth('October'),
    		$this->getByMonth('November'),
    		$this->getByMonth('December'),
    	];
    	$chart = new SampleChart;
    	$chart->dataset('Sample','line',$this_data)
    	-> options(['borderColor'=>'#ff0000']);
    	return view('chart_view',['chart'=>$chart]);
    }

    public function getByMonth($month)
    {
    	$count = Perhitungan::where('bulan',$month)->count();
    	return $count;
    }

    public function table()
    {
    	return view ('datatable');
    }
    public function list_data()
    {
    	return Datatables::of(Perhitungan::all())
    		   ->addColumn('test',function($this_model){
    		   		return '<a class="btn btn-primary btn-sm" href="/delete/'.$this_model->id.'">Action</a>';
    		   })
    		   ->addColumn('action',function($this_model){
    		   		return '<a class="btn btn-primary btn-sm" href="/delete/'.$this_model->id.'">Action</a>';
    		   })
    		   ->make(true);

    }
}
