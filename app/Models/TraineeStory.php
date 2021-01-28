<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TraineeStory extends Model
{
    use HasFactory;

    protected $fillable = [
        'session_pin',
        'story'
    ];
}
