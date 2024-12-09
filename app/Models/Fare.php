<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;

class Fare extends Model
{
    use HasApiTokens, HasFactory;

    protected $table = 'fares'; // Explicitly specify the table name
    protected $fillable = ['fare_location']; // Only include 'fare_location' as fillable

    // Define the relationship with FareLocation (one-to-many)
    public function fareLocations()
    {
        return $this->hasMany(FareLocation::class);
    }

    // Define the relationship with FareCollection (one-to-many)
    public function fareCollections()
    {
        return $this->hasMany(FareCollection::class);
    }

    // Define the relationship with Report (one-to-many)
    public function reports()
    {
        return $this->hasMany(Report::class);
    }
}
