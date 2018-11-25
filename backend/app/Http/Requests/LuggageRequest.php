<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LuggageRequest extends FormRequest
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
                        'takerName' => 'required',
                        'takerPhone1'  => 'required',
                        'takerPhone2' => 'nullable',
                        'mass'  => 'required',
                        'dsc'  => 'nullable',
                        'owner_id'=>'nullable',
                        'comertial' => 'required',
                        'value'  => 'required',
                        'price'  => 'required',
                        // 'from_lat'=> 'required',
                        // 'from_lng'=>'required',
                        'from_formatted_address'=>'required',
                        // 'from_place_id'=>'required',
                        // 'to_lat'=>'required',
                        // 'to_lng'=>'required',
                        'to_formatted_address'=>'required',
                        // 'to_place_id'=>'required',
                        'start_dt'      => 'required|date',
                        'end_dt'   => 'required|date',
                    ];
                }
            case 'PUT':
            case 'PATCH':
                {
                    return [
                        'takerName' => 'required',
                        'takerPhone1'  => 'required',
                        'takerPhone2' => 'nullable',
                        'mass'  => 'required',
                        'dsc'  => 'nullable',
                        'owner_id'=>'nullable',
                        'comertial' => 'required',
                        'value'  => 'required',
                        'price'  => 'required',
                        // 'from_lat' => 'required',
                        // 'from_lng' => 'required',
                        'from_formatted_address' => 'required',
                        // 'from_place_id' => 'required',
                        // 'to_lat' => 'required',
                        // 'to_lng' => 'required',
                        'to_formatted_address' => 'required',
                        // 'to_place_id'=> 'required',
                        'start_dt' => 'required|date',
                        'end_dt' => 'required|date',
                    ];
                }
            default:break;
        }
    }

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
                        'takerName.required' => 'Получатель',
                        'takerPhone1.required' => 'Номер получателя',
                        'takerPhone2.required' => 'Номер получателя 2',
                        'mass.required'   => 'Масса багажа',
                        'comertial.required' => 'Коммерческий/Некоммерческий',
                        'value.required' => 'Ценность товара',
                        'price.required' => 'Цена',
                        // 'from_lat.required'  => 'долгота Откуда',
                        // 'from_lng.required'  => 'широта Откуда',
                        'from_formatted_address.required'  => 'Откуда',
                        // 'from_place_id.required' => 'ID место Откуда',
                        // 'to_lat.required' => 'долгота Куда',
                        // 'to_lng.required' => 'широта Куда',
                        'to_formatted_address.required'  => 'Куда',
                        // 'to_place_id.required'  => 'ID место Куда',
                        'start_dt.required' => 'Дата вылета и время',
                        'end_d.required'   => 'Дата прилета и время',
                    ];
                }
            case 'PUT':
            case 'PATCH':
                {
                    return [
                        'takerName.required' => 'Получатель',
                        'takerPhone1.required' => 'Номер получателя',
                        'takerPhone2.required' => 'Номер получателя 2',
                        'mass.required'   => 'Масса багажа',
                        'comertial.required' => 'Коммерческий/Некоммерческий',
                        'value.required' => 'Ценность товара',
                        'price.required' => 'Цена',
                        // 'from_lat.required'  => 'долгота Откуда',
                        // 'from_lng.required'  => 'широта Откуда',
                        'from_formatted_address.required'  => 'Откуда',
                        // 'from_place_id.required' => 'ID место Откуда',
                        // 'to_lat.required' => 'долгота Куда',
                        // 'to_lng.required' => 'широта Куда',
                        'to_formatted_address.required'  => 'Куда',
                        // 'to_place_id.required'  => 'ID место Куда',
                        'start_dt.required' => 'Дата вылета и время',
                        'end_d.required'   => 'Дата прилета и время',
                    ];
                }
            default:break;
        }
    }
}
