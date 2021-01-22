<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TraineeJourney extends Model
{
    use HasFactory;

    protected $fillable = [
        'trainee_id',
        'session_type',
        'session_number',
        'session_pin'
    ];
}
