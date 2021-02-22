<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Task extends Model
{
    use HasFactory;
    use SoftDeletes;

        protected $fillable = [
		'booster_id',
		'booster_range',        	
        'task',
        'contextual_cue',
        'categorical_cue'
    ];
}
