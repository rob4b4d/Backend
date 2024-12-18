<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable 
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'bus_num',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        // Removed 'remember_token' as it's no longer needed
    ];

    /**
     * Automatically hash the password when setting it.
     */
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }

    /**
     * Relationships
     */
    public function fares()
    {
        return $this->hasMany(Fare::class);
    }

    public function reports()
    {
        return $this->hasMany(Report::class);
    }

    // Add relationship with fare collections
    public function fareCollections()
    {
        return $this->hasMany(FareCollection::class);
    }

    public function history()
    {
        return $this->hasMany(History::class);
    }
}
