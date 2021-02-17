<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Story extends Model
{
    use HasFactory;
    Use SoftDeletes;
    
    protected $fillable = [
    	'session_type',
    	'session_number',
        'story'  
    ];
}
