<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Charts\SampleChart;
use App\Http\Controllers\Controller;
use App\Perhitungan;

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
    	$chart->dataset('Sample','line',$this_data);
    	return view('chart_view',['chart'=>$chart]);
    }

    public function getByMonth($month)
    {
    	$count = Perhitungan::where('bulan',$month)->count();
    	return $count;
    }
}
