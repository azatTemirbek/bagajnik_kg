<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
                    return [];
                }
            case 'PUT':
            case 'PATCH':
                {
                    return [
                      'name' => 'required',
                      'surname'  => 'required',
                      'phone'  => 'required',
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
                    return [];
                }
            case 'PUT':
            case 'PATCH':
                {
                    return [
                        'name.required' => 'Имя',
                        'surname.required' => 'Фамилия',
                        'phone.required' => 'Номер',
                    ];
                }
            default:break;
        }
    }
}
