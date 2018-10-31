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
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {

        switch($this->method())
        {
            case 'GET':
            case 'DELETE':
                {
                    return [];
                }
            case 'POST':
                {
                    return [
                        'from' => 'required',
                        'to'  => 'required',
                        'start_dt'      => 'required|date|date_format:Y-m-d|after:yesterday',
                        'end_dt'   => 'required|date|date_format:Y-m-d|after:start_dt',
                    ];
                }
            case 'PUT':
            case 'PATCH':
                {
                    return [
                        'from' => 'required',
                        'to'  => 'required',
                        'start_dt'      => 'required|date|date_format:Y-m-d|after:yesterday',
                        'end_dt'   => 'required|date|date_format:Y-m-d|after:start_dt',
                    ];
                }
            default:break;
        }
    }
    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        switch($this->method())
        {
            case 'GET':
            case 'DELETE':
                {
                    return [];
                }
            case 'POST':
                {
                    return [
                        'from.required' => 'Откуда',
                        'to.required' => 'Куда',
                        'start_dt.required' => 'Дата вылета и время',
                        'end_d.required'   => 'Дата прилета и время',
                    ];
                }
            case 'PUT':
            case 'PATCH':
                {
                    return [
                        'from.required' => 'Откуда',
                        'to.required' => 'Куда',
                        'start_dt.required' => 'Дата вылета и время',
                        'end_d.required'   => 'Дата прилета и время',
                        ];
                }
            default:break;
        }
    }
}
