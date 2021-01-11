<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'planned_start',
        'planned_finish',
        'actual_start', 
        'actual_finish',
        'percent_complete',
        'comment',
    ];
}
