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
                        // 'from_lat' => 'required',
                        // 'from_lng' => 'required',
                        // 'from_place_id' => 'required',
                        // 'to_lat' => 'required',
                        // 'to_lng' => 'required',
                        // 'to_place_id'=> 'required',
                        'to_formatted_address' => 'required',
                        'from_formatted_address' => 'required',
                        'start_dt'      => 'required|date',
                        // 'start_dt'      => 'required|date|after:yesterday',
                        'end_dt'   => 'required|date',
                        // 'end_dt'   => 'required|date|after:start_dt',
                    ];
                }
            case 'PUT':
            case 'PATCH':
                {
                    return [
                        // 'from_lat' => 'required',
                        // 'from_lng' => 'required',
                        // 'from_place_id' => 'required',
                        // 'to_lat' => 'required',
                        // 'to_lng' => 'required',
                        // 'to_place_id'=> 'required',
                        'to_formatted_address' => 'required',
                        'from_formatted_address' => 'required',
                        'start_dt'      => 'required|date',
                        // 'start_dt'      => 'required|date|after:yesterday',
                        'end_dt'   => 'required|date',
                        // 'end_dt'   => 'required|date|after:start_dt',
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
                        // 'from_lat.required'  => 'долгота Откуда',
                        // 'from_lng.required'  => 'широта Откуда',
                        // 'from_place_id.required' => 'ID место Откуда',
                        // 'to_lat.required' => 'долгота Куда',
                        // 'to_lng.required' => 'широта Куда',
                        // 'to_place_id.required'  => 'ID место Куда',
                        'to_formatted_address.required'  => 'Куда необходимо!',
                        'from_formatted_address.required'  => 'Откуда необходимо!',
                        'start_dt.required' => 'Дата вылета необходимо!',
                        'end_dt.required'   => 'Дата прилета необходимо!',
                    ];
                }
            case 'PUT':
            case 'PATCH':
                {
                    return [
                        // 'from_lat.required'  => 'долгота Откуда',
                        // 'from_lng.required'  => 'широта Откуда',
                        // 'from_place_id.required' => 'ID место Откуда',
                        // 'to_lat.required' => 'долгота Куда',
                        // 'to_lng.required' => 'широта Куда',
                        // 'to_place_id.required'  => 'ID место Куда',
                        'to_formatted_address.required'  => 'Куда необходимо!',
                        'from_formatted_address.required'  => 'Откуда необходимо!',
                        'start_dt.required' => 'Дата вылета необходимо!',
                        'end_dt.required'   => 'Дата прилета необходимо!',
                        ];
                }
            default:break;
        }
    }
}
