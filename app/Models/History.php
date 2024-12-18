<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class History extends Model
{
    use HasFactory;

    protected $table = 'history';

    protected $fillable = [
        'fcollection_id',
        'user_id',
    ];

    /**
     * Relationship to User model.
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Relationship to FareCollection model.
     */
    public function fareCollection()
    {
        return $this->belongsTo(FareCollection::class, 'fcollection_id');
    }
}
