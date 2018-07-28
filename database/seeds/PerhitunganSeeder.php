<?php
use App\Perhitungan;
use Illuminate\Database\Seeder;

class PerhitunganSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create(); 
        $batas = 100;

        for ($i=0;$i<=$batas;$i++){
        	Perhitungan::create([ 
        		'transaksi' => $faker->randomNumber(5),
        		'bulan' => $faker->monthName, 
        	]);
        }
    }
}
