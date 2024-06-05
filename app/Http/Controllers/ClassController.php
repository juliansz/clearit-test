<?php

namespace App\Http\Controllers;
use App\Models\BookedClass;
use App\Models\Classroom;
use App\Models\Timetable;
use App\Http\Requests\CreateClassRequest;
use App\Http\Requests\DeleteClassRequest;
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

        return response(json_encode($classes), 200);
    }

    function postClass(CreateClassRequest $request){
        $classroom = Classroom::where('name', 'like', $request->input('classroom_name'))->first();
        $data = $request->only('starts_at', 'ends_at');
        $data['classroom_id'] = $classroom->id;
        $class = BookedClass::create($data);
        return response(json_encode($class), 200);
    }

    function deleteClass(DeleteClassRequest $request, BookedClass $bookedClass){
        $bookedClass->delete();
        return response('Class canceled', 200);
    }
}