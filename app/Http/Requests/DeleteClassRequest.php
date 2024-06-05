<?php
namespace App\Http\Requests;

use App\Models\Classroom;
use App\Models\BookedClass;
use App\Models\Timetable;
use Carbon\Carbon;
use Closure;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;

class DeleteClassRequest extends FormRequest
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
        $class = $this->route()->parameters['bookedClass'];
        if($class->starts_at->subDay() <= Carbon::now()){
            throw ValidationException::withMessages([
                "starts_at" => ["Classes cannot be canceled within 24 hours before the start"], 
            ]);
        }
        return [];
    }
}