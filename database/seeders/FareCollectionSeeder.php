<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\FareCollection;
use App\Models\User; // Ensure you import the User model

class FareCollectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Ensure you have corresponding `fares` data for `fare_id`
        // Make sure you have existing users in the users table, or create a new one for testing
        
        $user = User::first(); // Get the first user or use a specific user ID

        FareCollection::create([
            'route' => 1,
            'regular_total' => '500',
            'discounted_total' => '200',
            'pick_up_total' => '50',
            'fare_id' => 3, // Ensure fare with ID 1 exists
            'user_id' => $user->id, // Associate with the first user
        ]);

        FareCollection::create([
            'route' => 2,
            'regular_total' => '600',
            'discounted_total' => '250',
            'pick_up_total' => '70',
            'fare_id' => 4, // Ensure fare with ID 2 exists
            'user_id' => $user->id, // Associate with the first user
        ]);
    }
}
