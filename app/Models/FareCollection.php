<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FareCollection extends Model
{
    use HasFactory;

    protected $table = 'fare_collections';

    protected $fillable = [
        'name',
        'regular_total',
        'discounted_total',
        'fare_id',
        'user_id',
        'bus_num',
        'route',
    ];

    // Define relationship with the Fare model
    public function fare()
    {
        return $this->belongsTo(Fare::class);
    }

    // Define relationship with the User model
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    // In FareCollection.php
    public function reports()
    {
        return $this->hasMany(Report::class);
    }

    public function history()
    {
        return $this->hasMany(History::class);
    }

    public function fareLocation()
    {
        return $this->hasMany(FareLocation::class);
    }

    }
