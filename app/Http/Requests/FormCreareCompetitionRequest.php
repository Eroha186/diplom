<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FormCreareCompetitionRequest extends FormRequest
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
        return [
            'title' => 'required|string|max:30',
            'annotation' => 'required|string|max:350',
            'cover' => 'required',//'required|mimes:jpg,png,jpeg',
            'type-competition' => 'required|min:0',
            'date-begin' => 'required',
            'date-end' => 'required',
        ];
    }
}
