<?php

namespace App\Http\Controllers;
use App\Models\BookedClass;
use App\Models\Classroom;
use App\Models\Timetable;
use App\Http\Requests\CreateClassRequest;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ClassController extends Controller
{
    function getClasses(){
        $today = Carbon::now()->dayOfWeek;
        $week_start = Carbon::now()->subDays($today);
        $week_end = $week_start->copy()->addDays(6)->format('Y-m-d 23:59:59');
        $week_start = $week_start->format('Y-m-d 00:00:00');
        
        $classes = BookedClass::where('starts_at', '>=', $week_start)
            ->where('ends_at', '>=', $week_end)
            ->get();

        return json_encode($classes);
    }

    function postClass(CreateClassRequest $request){
        // TODO: things to handle in the request: 
        // empty fields, formats string / datetimes, 
        // unexisting classroom 
        // the classroom should be available during the required slot
        // validate starts_at and ends_at to be 00:00 and 59:59 respectively???
        $classroom = Classroom::where('name', 'like', $request->input('classroom_name'))->first();
        $data = $request->only('starts_at', 'ends_at');
        $data['classroom_id'] = $classroom->id;
        $class = BookedClass::create($data);
        return json_encode($class);
    }

    function deleteClass(Request $request, BookedClass $bookedClass){
        // TODO: things to handle in the request:
        // less than 24 hours before the class
        $bookedClass->delete();
        return response('Class canceled', 200);
    }
}