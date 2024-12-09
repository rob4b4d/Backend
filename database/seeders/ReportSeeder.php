<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Fare;
use App\Models\FareCollection;
use App\Models\Report;
use Illuminate\Database\Seeder;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ReportSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
                // Get the first user, fare, and fare collection (ensure they exist)
                $user = User::first(); // You can change this to get specific user
                $fare = Fare::first(); // You can change this to get specific fare
                $fareCollection = FareCollection::first(); // You can change this to get specific fare collection
        
                // Ensure the records exist before inserting into the reports table
                if ($user && $fare && $fareCollection) {
                    // Create a new report
                    Report::create([
                        'user_id' => $user->id,
                        'fare_id' => $fare->id,
                        'fare_collection_id' => $fareCollection->id,
                    ]);
                } else {
                    // Optionally, you can output a message if the data does not exist
                    echo "Required data (user, fare, or fare collection) does not exist in the database.";
                }
    }
}
