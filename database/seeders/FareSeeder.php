<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Fare;

class FareSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {   
        Fare::create([
            'fare_location' => 'Asingan',
        ]);

        Fare::create([
            'fare_location' => 'Sta Maria',
        ]);

        Fare::create([
            'fare_location' => 'Urdaneta',
        ]);

        Fare::create([
            'fare_location' => 'Dagupan',
        ]);
    }
}
