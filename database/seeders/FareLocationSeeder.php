<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\FareLocation;
use App\Models\Fare;

class FareLocationSeeder extends Seeder
{
    public function run()
    {
        // Assuming Fare records are already created, now create FareLocation records
        FareLocation::create([
            'fare_location' => 'Asingan - San Quintin',
            'regular_price' => 50,
            'discounted_price' => 30,
            'fare_id' => 1,  // Referencing the Fare ID (should match an existing Fare)
        ]);

        FareLocation::create([
            'fare_location' => 'Sta Maria - San Manuel',
            'regular_price' => 60,
            'discounted_price' => 40,
            'fare_id' => 2,  // Referencing the second Fare ID
        ]);
    }
}
