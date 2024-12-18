<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FareLocation extends Model
{
    use HasFactory;

    protected $table = 'fare_locations'; // Explicitly specify the table name
    protected $fillable = ['fare_location', 'regular_price', 'discounted_price', 'fare_id'];

    public function fare()
    {
        return $this->belongsTo(Fare::class);
    }

}
