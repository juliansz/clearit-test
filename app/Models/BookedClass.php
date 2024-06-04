<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookedClass extends Model
{
    use HasFactory;

    protected $table = 'classes';

    protected $fillable = ['starts_at', 'ends_at', 'classroom_id'];
}