<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Models\Fare;
use App\Models\FareCollection;

class ReportFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => User::factory(),
            'fare_id' => Fare::factory(),
            'fare_collection_id' => FareCollection::factory(),
        ];
    }
}
