<?php

namespace Database\Seeders;
require_once 'vendor/autoload.php';

use App\Models\Movie;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;


class MoviesTableSeeder extends Seeder
{
    
    /**
     * Run the database seeds.
     * @return void
     */
    public function run()
    {
        Movie::truncate();
        //
        $faker= \Faker\Factory::create();   
        for($i=0;$i<10;$i++){
            Movie::create([
                'title' => $faker->sentence(),
                'synopsis' =>$faker->paragraph(),
                'year' => $faker->year(),
                'cover' => $faker->sentence(),
                ]);
        }
        
    }
}
