<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Classroom extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'capacity', 'period_in_hours'];

    public function timetables(): HasMany
    {
        return $this->hasMany(Timetable::class);
    }
}
