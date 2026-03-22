<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GuestMeal extends Model
{
    use HasFactory;

    // Allow mass assignment for these fields
    protected $fillable = [
        'user_id',
        'date',
        'number_of_guest_meal',
    ];

    /**
     * Relationship: GuestMeal belongs to a User
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
