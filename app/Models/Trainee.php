<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trainee extends Model
{
    use HasFactory;

    protected $fillable = [
        'trainee_id',
        'trainer_id',
        'session_type',
        'session_number',
        'session_pin'
    ];
}
