<?php

namespace App\Http\Requests\Trip;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTripRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            "vehicle_id"    =>"required|numeric|exists:drivers,id|min:1",
            "driver_id"     =>"required|numeric|exists:vehicles,id|min:1",
            "license"       =>"required|string|min:1|max:1",
        ];
    }
}
