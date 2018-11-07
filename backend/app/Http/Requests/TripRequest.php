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
                        'from_lat' => 'required',
                        'from_lng' => 'required',
                        'from_formatted_address' => 'required',
                        'from_place_id' => 'required',
                        'to_lat' => 'required',
                        'to_lng' => 'required',
                        'to_formatted_address' => 'required',
                        'to_place_id'=> 'required',
                        'start_dt'      => 'required|date|date_format:Y-m-d|after:yesterday',
                        'end_dt'   => 'required|date|date_format:Y-m-d|after:start_dt',
                    ];
                }
            case 'PUT':
            case 'PATCH':
                {
                    return [
                        'from_lat'=> 'required',
                        'from_lng'=>'required',
                        'from_formatted_address'=>'required',
                        'from_place_id'=>'required',
                        'to_lat'=>'required',
                        'to_lng'=>'required',
                        'to_formatted_address'=>'required',
                        'to_place_id'=>'required',
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
                        'from_lat.required'  => 'долгота Откуда',
                        'from_lng.required'  => 'широта Откуда',
                        'from_formatted_address.required'  => 'Откуда',
                        'from_place_id.required' => 'ID место Откуда',
                        'to_lat.required' => 'долгота Куда',
                        'to_lng.required' => 'широта Куда',
                        'to_formatted_address.required'  => 'Куда',
                        'to_place_id.required'  => 'ID место Куда',
                        'start_dt.required' => 'Дата вылета и время',
                        'end_d.required'   => 'Дата прилета и время',
                    ];
                }
            case 'PUT':
            case 'PATCH':
                {
                    return [
                        'from_lat.required'  => 'долгота Откуда',
                        'from_lng.required'  => 'широта Откуда',
                        'from_formatted_address.required'  => 'Откуда',
                        'from_place_id.required' => 'ID место Откуда',
                        'to_lat.required' => 'долгота Куда',
                        'to_lng.required' => 'широта Куда',
                        'to_formatted_address.required'  => 'Куда',
                        'to_place_id.required'  => 'ID место Куда',
                        'start_dt.required' => 'Дата вылета и время',
                        'end_d.required'   => 'Дата прилета и время',
                        ];
                }
            default:break;
        }
    }
}
