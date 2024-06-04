<?php

namespace App\Http\Controllers;
use App\Models\BookedClass;
use App\Models\Classroom;
use App\Models\Timetable;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ClassController extends Controller
{
    function getClasses(){
        $today = Carbon::now()->dayOfWeek;
        $week_start = Carbon::now()->subDays($today); //hay que restar tambien las horas
        $week_end = $week_start->copy()->addDays(6)->format('d-m-Y 23:59:59');
        $week_start = $week_start->format('d-m-Y 00:00:00');
        
        $classes = BookedClass::where('starts_at', '>=', $week_start)
            ->where('ends_at', '>=', $week_end)
            ->get();

        return json_encode($classes);
    }

    function postClass(Request $request){
    }

    function deleteClass(Request $request, BookedClass $bookedClass){
    }
}