<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Meal extends Model
{
    use HasFactory;

    // Table name (optional if it follows Laravel convention)
    protected $table = 'meals';

    // Mass assignable attributes
    protected $fillable = [
        'user_id',
        'date',
        'breakfast',
        'lunch',  // note: you wrote 'launch' instead of 'lunch'
        'dinner',
    ];

    // Cast boolean fields
    protected $casts = [
        'breakfast' => 'boolean',
        'lunch'    => 'boolean', // again, consider renaming to 'lunch'
        'dinner'    => 'boolean',
        'date'      => 'date',
    ];

    /**
     * Relationship: Meal belongs to a User
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function mealsOnDate($date)
    {
        return $this->meals()->whereDate('date', $date);
    }

   
}
