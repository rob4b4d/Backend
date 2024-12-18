<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;

    // Define the table name if it differs from the plural of the model name
    // protected $table = 'reports';

    // Mass assignment protection
    protected $fillable = [
        'user_id',
        'fare_id',
        'fare_collection_id',
    ];

    /**
     * Get the user that owns the report.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the fare that the report references.
     */
    public function fare()
    {
        return $this->belongsTo(Fare::class);
    }

    /**
     * Get the fare collection that the report references.
     */
    public function fareCollection()
    {
        return $this->belongsTo(FareCollection::class, 'fare_collection_id');
    }
}
