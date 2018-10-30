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
//                        'user.name.last'  => 'required',
//                        'user.email'      => 'required|email|unique:users,email',
//                        'user.password'   => 'required|confirmed',
                    ];
                }
            case 'PUT':
            case 'PATCH':
                {
                    return [
//                        'user.name.first' => 'required',
//                        'user.name.last'  => 'required',
//                        'user.email'      => 'required|emAd,
//                        'user.password'   => 'required|confirmed',
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
                        'from.required' => 'Kaydan bolgonun jaziniz',
                        'user.name.last'  => 'required',
                        'user.email'      => 'required|email|unique:users,email',
                        'user.password'   => 'required|confirmed',
                    ];
                }
            case 'PUT':
            case 'PATCH':
                {
                    return [
                        'user.' => 'required',
                        'user.name.last'  => 'required',
                        'user.email'      => 'required|email|unique:users,email,'.$user->id,
                        'user.password'   => 'required|confirmed',
                    ];
                }
            default:break;
        }
    }
}
