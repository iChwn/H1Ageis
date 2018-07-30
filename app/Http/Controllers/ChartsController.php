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
    	$data = Perhitungan::all();
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
    	return view('Chart.chart_view',['chart'=>$chart])->with(compact('data'));
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

    public function create()
	{
		return view('Chart.create');	
	}

	public function store(Request $request)
	{
		$this->validate($request,[
			'transaksi' => 	'required',
			'bulan'		=>	'required'
			]);
		$data = new Perhitungan();
		$data->transaksi = $request->transaksi;
		$data->bulan = $request->bulan;
		$data->save();
		return redirect()->route('chart.index')->with('alert-success','Berhasil Menambahkan Data!');
	}

	public function edit($id)
	{
		$data = Perhitungan::where('id',$id)->get();
		return view ('Chart.edit')->with(compact('data'));
	}

	public function update(Request $request,$id)
	{
		$data = Perhitungan::where('id',$id)->first();
		$data->transaksi = $request->transaksi;
		$data->bulan = $request->bulan;
		$data->save();
		return redirect()->route('chart.index')->with('alert-success','Berhasil Mengedit Data!');
	}

    public function hapus($id)
    {
    	Perhitungan::destroy($id);
    	return redirect()->back()->with('alert-danger','Berhasil Menghapus Data!');

    }
}
