<?php

namespace App\Charts;

use ConsoleTVs\Charts\Classes\Chartjs\Chart;
use App\Http\Controllers\PenjualansController;

class PenjualansChart extends Chart
{
    /**
     * Initializes the chart.
     *
     * @return void
     */
    public function Chart($year,$month)
    {
    	$data = Penjualan::all();
    	$calendar = cal_days_in_month(CAL_GREGORIAN, $month, $year);
    	$cat_data = array();
    	for($i=1;$i<=$calendar;$i++){
    		$tgl = $year.'-'.$month.'-'.($i+00);
    		$cat_data[] = $this->getByMonth($year,$month,$tgl);
    	}
    	return $cat_data;
    }


    public function __construct()
    {
    	parent::__construct();
    	$bulan = 2;
    	$tahun = 2018;
    	$tampung = array();
        $number = cal_days_in_month(CAL_GREGORIAN, $bulan, $tahun); // 31
        for ($i=1; $i <=$number ; $i++) { 
        	$tampung[]= $i;
        }
        $bulan = $tampung;

        $this->labels($bulan)->options(['legend' =>['display' => false]]);
    }
    

}
