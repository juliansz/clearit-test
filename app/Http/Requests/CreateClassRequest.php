<?php
namespace App\Http\Requests;

use App\Models\Classroom;
use App\Models\BookedClass;
use App\Models\Timetable;
use Carbon\Carbon;
use Closure;
use Illuminate\Foundation\Http\FormRequest;

class CreateClassRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'starts_at' => 'required|date_format:Y-m-d H:i:s|before:ends_at', 
            'ends_at' => 'required|date_format:Y-m-d H:i:s|after:starts_at', 
            'classroom_name' => [
                'required', 
                'string',
                function (string $attribute, mixed $value, Closure $fail) {
                    // the classroom exist
                    $classroom = Classroom::where('name', 'like', $this->input('classroom_name'))->first();
                    if (!$classroom instanceof Classroom) {
                        $fail("The {$attribute} does not exist.");
                    }

                    // the classroom is available on the selected day
                    $day_of_week = Carbon::parse($this->starts_at)->dayOfWeek;
                    $date = Carbon::parse($this->starts_at)->format('Y-m-d');

                    // To simplify the validations I assumed that each classroom will only have ONE timetable per weekday
                    $timetable = $classroom->timetables->where('day_of_week', $day_of_week)->first();
                   
                    if (!$timetable instanceof Timetable) {
                        $fail("The classroom is not available on the selected date");
                    }

                    // the classroom is available on the selected times
                    $timetable_start = Carbon::parse($date . " " . $timetable->start_time);
                    $timetable_end = Carbon::parse($date . " " . $timetable->end_time);

                    if(!($timetable_start<= $this->starts_at) || !($timetable_end >= $this->ends_at)){
                        $fail("The classroom is not available on the selected slot");
                    }

                    // there are no booked classes overlapping the requested times
                    $overlapping_classes = BookedClass::where('classroom_id', $classroom->id)
                        ->where(function ($q) {
                            $q->where('starts_at', '<=', $this->starts_at)->where('ends_at', '>=', $this->starts_at);
                        })->orWhere(function ($q) {
                            $q->where('starts_at', '>=', $this->starts_at)->where('starts_at', '<=', $this->ends_at);
                        })->count();

                    if($overlapping_classes){
                        $fail("The classroom is not available on the selected slot");
                    }
                },
            ]
        ];
    }
}