<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OfferRequest extends FormRequest
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
                        'agree' => 'required',
                        'status'  => 'required',
                    ];
                }
            case 'PUT':
            case 'PATCH':
                {
                    return [
                        'agree' => 'required',
                        'status'  => 'required',
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
                        'agree.required' => 'Согласны ли вы взять этот заказ?',
                        'status.required' => 'Статус заказа',
                        ];

                }
            case 'PUT':
            case 'PATCH':
                {
                    return [
                        'agree.required' => 'Согласны ли вы взять этот заказ?',
                        'status.required' => 'Статус заказа',
                    ];
                }
            default:break;
        }
    }
}
