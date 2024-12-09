<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FareCollection extends Model
{
    use HasFactory;

    protected $table = 'fare_collections';

    // Update the $fillable property to include 'user_id'
    protected $fillable = [
        'route',
        'regular_total',
        'discounted_total',
        'pick_up_total',
        'fare_id',
        'user_id', // Added user_id to the fillable array
    ];

    // Define the relationship with the Fare model
    public function fare()
    {
         return $this->belongsTo(Fare::class);
    }

    // Define the relationship with the User model
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
