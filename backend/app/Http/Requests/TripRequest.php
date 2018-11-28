<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TripRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {

        switch ($this->method()) {
            case 'GET':
            case 'DELETE':
                {
                    return [];
                }
            case 'POST':
                {
                    return [
                        'to_formatted_address' => 'required',
                        'from_formatted_address' => 'required',
                        'start_dt' => 'required|date',
                        'end_dt' => 'required|date',
                    ];
                }
            case 'PUT':
            case 'PATCH':
                {
                    return [
                        'to_formatted_address' => 'required',
                        'from_formatted_address' => 'required',
                        'start_dt' => 'required|date',
                        'end_dt' => 'required|date',
                        // 'start_dt'      => 'required|date|after:yesterday',
                        // 'end_dt'   => 'required|date|after:start_dt',
                    ];
                }
            default:
                break;
        }
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        switch ($this->method()) {
            case 'GET':
            case 'DELETE':
                {
                    return [];
                }
            case 'POST':
                {
                    return [
                        'to_formatted_address.required' => 'Куда необходимо!',
                        'from_formatted_address.required' => 'Откуда необходимо!',
                        'start_dt.required' => 'Дата вылета необходимо!',
                        'end_dt.required' => 'Дата прилета необходимо!',
                    ];
                }
            case 'PUT':
            case 'PATCH':
                {
                    return [
                        'to_formatted_address.required' => 'Куда необходимо!',
                        'from_formatted_address.required' => 'Откуда необходимо!',
                        'start_dt.required' => 'Дата вылета необходимо!',
                        'end_dt.required' => 'Дата прилета необходимо!',
                    ];
                }
            default:
                break;
        }
    }
}
