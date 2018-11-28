<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RatingRequest extends FormRequest
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
                        'rate_value' => 'required',
                        'comment' => 'nullable',
                    ];
                }
            case 'PUT':
            case 'PATCH':
                {
                    return [
                        'rate_value' => 'required',
                        'comment' => 'nullable',
                    ];
                }
            default:
                break;
        }
    }

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
                        'rate_value.required' => 'Пожалуйста, оцените работу пользователя',
                        'comment.required' => 'Можете оставить свои комментарии',
                    ];
                }
            case 'PUT':
            case 'PATCH':
                {
                    return [
                        'rate_value.required' => 'Пожалуйста, оцените работу пользователя',
                        'comment.required' => 'Можете оставить свои комментарии',
                    ];
                }
            default:
                break;
        }
    }
}
