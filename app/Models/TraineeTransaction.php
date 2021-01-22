<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TraineeTransaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'session_pin'
    ];
}
