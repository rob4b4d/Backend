<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\FareCollection;
use App\Models\User;

class FareCollectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Ensure there are existing users in the users table
        $user = User::first(); // Retrieve the first user
        if (!$user) {
            $this->command->error('No users found in the database. Please create a user first.');
            return;
        }

        // Seed fare collections
        FareCollection::create([
            'route' => 1,
            'regular_total' => 500.00,
            'discounted_total' => 200.00,
            'fare_id' => 1, // Ensure fare with this ID exists
            'user_id' => $user->id,
            'name' => $user->name,
            'bus_num' => 4321,
        ]);

        FareCollection::create([
            'route' => 2,
            'regular_total' => 600.00,
            'discounted_total' => 250.00,
            'fare_id' => 2, // Ensure fare with this ID exists
            'user_id' => $user->id,
            'name' => $user->name,
            'bus_num' => 5432,
        ]);
    }
}
