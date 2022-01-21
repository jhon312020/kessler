<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class General extends Model
{
    use HasFactory;
    use SoftDeletes;
    
    protected $fillable = [
        'story_id',
        'word',
        'contextual_cue',
        'question',
        'categorical_cue',
        'words',
        'type'  
    ];
}