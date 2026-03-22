<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bazar extends Model
{
    use HasFactory;

    // Table name (optional if it follows Laravel convention)
    protected $table = 'bazars';

    // Mass assignable attributes
    protected $fillable = [
        'description',
        'cost',
        'date',
        'names',
        'bazar_floor',
        
    ];

    // Cast attributes
    protected $casts = [
        'date' => 'date',
        'amount' => 'decimal:2',
    ];
}
