<?php
use App\Penjualan;
use Illuminate\Database\Seeder;

class PenjualanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create(); 
        $batas = 1000;

        for ($i=0;$i<=$batas;$i++){
        	Penjualan::create([ 
        		'penjualan' => $faker->randomNumber(5),
        		'tanggal' => $faker->dateTimeThisYear($max = 'now', $timezone = null)
        	]);
        }
    }
}
