<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Word extends Model
{
    use HasFactory;
    use SoftDeletes;

        protected $fillable = [
        'story_id',	
        'word',
        'contextual_cue',
        'categorical_cue'
    ];
}
