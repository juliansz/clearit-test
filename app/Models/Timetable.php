<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Timetable extends Model
{
    use HasFactory;

    protected $fillable = ['day_of_week', 'start_time', 'end_time', 'classroom_id'];

    public function classroom(): BelongsTo
    {
        return $this->belongsTo(Classroom::class);
    }
}