<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class FormCompetitionRequest extends FormRequest
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
        if (Auth::check()) {
            return [
                'competition' => 'required|min:0',
                'nomination' => 'required|min:0',
                'education' => 'required|min:0',
                'title' => 'required|string',
                'annotation' => 'required|string|max:200',
                'file' => 'required',
                'offer' => 'accepted',
                'processing-pd' => 'accepted',
                'fc' => 'required|string|max:30',
                'ic' => 'required|string|max:30',
                'oc' => 'required|string|max:30',
            ];
        } else {
            return [
                'f' => 'required|string|max:30',
                'i' => 'required|string|max:30',
                'o' => 'required|string|max:30',
                'job' => 'required|string',
                'stuff' => 'required|string',
                'town' => 'required|string',
                'competition' => 'required|min:0',
                'nomination' => 'required|min:0',
                'education' => 'required|min:0',
                'title' => 'required|string',
                'annotation' => 'required|string|max:200',
                'file' => 'required|mimes:jpg,png,doc,docx,pdf,ppt,pptx',
                'offer' => 'accepted',
                'processing-pd' => 'accepted',
                'fc' => 'required|string|max:30',
                'ic' => 'required|string|max:30',
                'oc' => 'required|string|max:30',
            ];
        }
    }

    public function messages()
    {

        return [
            'f.required' => 'Укажите вашу Фамилию',
            'i.required' => 'Укажите ваше Имя',
            'o.required' => 'Укажите ваше Отчество',
            'job.required' => 'Укажите вашу Должность',
            'email' => [
                'required' => 'Укажите ваш E-mail',
                'email' => 'Некорректный адрес электронной почты',
                'unique' => 'Пользователь с таким E-mail существует',
            ],
            'stuff.required' => 'Укажите наименования вашего образовательного учреждения',
            'town.required' => 'Укажите ваш город',
            'education.required' => 'Укажите уровень образования',
            'fc.required' => 'Укажите вашу Фамилию ребенка',
            'ic.required' => 'Укажите ваше Имя ребенка',
            'oc.required' => 'Укажите ваше Отчество ребенка',
            'title.required' => 'Укажите название работы',
            'annotation.required' => 'Укажите описание работы',
            'file.required' => 'Не забудьте приложить файлы',
            'file.mime' => 'Не поддерживаемый формат',
            'offer.accepted' => 'Согласие с условиями оферты должно быть принято',
            'processing-pd' => 'Согласие на обработку персональных данных должно быть принято',
        ];
    }
}
