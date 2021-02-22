<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Trainee extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'trainee_id',
        'trainer_id',
        'session_type',
        'session_number',
        'booster_id',
        'booster_range',
        'session_pin'
    ];
}
