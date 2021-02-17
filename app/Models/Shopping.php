<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Shopping extends Model
{
    use HasFactory;
    use SoftDeletes;

        protected $fillable = [
        'story_id',	
        'item',
        'contextual_cue',
        'categorical_cue'
    ];
}
