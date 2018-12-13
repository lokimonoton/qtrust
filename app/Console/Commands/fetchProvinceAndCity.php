<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\City;
use App\Province;


class fetchProvinceAndCity extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fetch:province';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fetch province and city from raja ongkir to database rajaongkir';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        City::truncate();
        Province::truncate();
        
        $cityJson=json_decode(file_get_contents("https://api.rajaongkir.com/starter/city?key=0df6d5bf733214af6c6644eb8717c92c"))->rajaongkir->results;
        $provinceJson=json_decode(file_get_contents("https://api.rajaongkir.com/starter/province?key=0df6d5bf733214af6c6644eb8717c92c"))->rajaongkir->results;
        foreach($cityJson as $cityJ){
        $user = new City;

$user->city_id = $cityJ->city_id;
$user->province_id = $cityJ->province_id;
$user->province = $cityJ->province;
$user->type = $cityJ->type;
$user->city_name = $cityJ->city_name;
$user->postal_code = $cityJ->postal_code;

$user->save();
            
        }
        foreach($provinceJson as $provinceJ){
                    $user = new Province;

$user->province_id = $provinceJ->province_id;
$user->province = $provinceJ->province;


$user->save();
        }
        
        $this->info("done");
        
    }
}
