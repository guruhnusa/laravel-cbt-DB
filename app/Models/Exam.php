<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'score_numeric',
        'score_verbal',
        'score_logika',
        'result',
        'status_numeric',
        'status_verbal',
        'status_logika',
        'timer_numeric',
        'timer_verbal',
        'timer_logika',

    ];
}
