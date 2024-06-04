<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BookedClass extends Model
{
    use HasFactory;
    use SoftDeletes;
    
    protected $table = 'classes';

    protected $fillable = ['starts_at', 'ends_at', 'classroom_id'];
}