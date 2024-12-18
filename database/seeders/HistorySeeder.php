<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\History;
use App\Models\User;
use App\Models\FareCollection;
use Illuminate\Support\Facades\DB;

class HistorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Ensure there are users and fare_collections to reference
        $user = User::first() ?? User::factory()->create();
        $fareCollection = FareCollection::first() ?? FareCollection::factory()->create();

        // Seed the history table with sample data
        History::create([
            'fcollection_id' => $fareCollection->id,
            'user_id' => $user->id,
            'date' => now(), // Use the current timestamp
        ]);

        History::create([
            'fcollection_id' => $fareCollection->id,
            'user_id' => $user->id,
            'date' => now()->subDays(1), // 1 day ago
        ]);

        History::create([
            'fcollection_id' => $fareCollection->id,
            'user_id' => $user->id,
            'date' => now()->subDays(2), // 2 days ago
        ]);

        // Optional: Output a message to the console
        $this->command->info('History table seeded successfully.');
    }
}
