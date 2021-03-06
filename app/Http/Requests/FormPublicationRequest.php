<?php

namespace App\Http\Requests;

use App\Type;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class FormPublicationRequest extends FormRequest
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
                'education' => 'required|min:0',
                'kind' => 'required|min:0',
                'title' => 'required|string',
                'type' => 'required|min:0',
                'annotation' => 'required|string|max:200',
                'text' => 'required|min:' . (is_null($this->get('type')) ? '1000' : Type::where('id', $this->get('type'))->first()->number_symbols),
                'filesId' => 'required',
                'offer' => 'accepted',
                'processing-pd' => 'accepted',
            ];
        } else {
            return [
                'f' => 'required|string|max:30',
                'i' => 'required|string|max:30',
                'o' => 'required|string|max:30',
                'job' => 'required|string',
                'stuff' => 'required|string',
                'town' => 'required|string',
                'education' => 'required|min:0',
                'kind' => 'required|min:0',
                'title' => 'required|string',
                'text' => 'required|min:' . (is_null($this->get('type')) ? '1000' : Type::where('id', $this->get('type'))->first()->number_symbols),
                'type' => 'required|min:0',
                'filesId' => 'required',
                'annotation' => 'required|string|max:100',
                'offer' => 'accepted',
                'processing-pd' => 'accepted',
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
            'kind.required' => 'Укажите вид публикации',
            'title.required' => 'Укажите название работы',
            'type.required' => 'Укажите тип работы',
            'themes.required' => 'Укажите тематику работы',
            'annotation.required' => 'Укажите описание работы',
            'files.required' => 'Не забудьте приложить файлы',
            'files.*.file' => 'Должен быть файл',
            'files.*.mime' => 'Не поддерживаемый формат',
            'offer.accepted' => 'Согласие с условиями оферты должно быть принято',
            'processing-pd' => 'Согласие на обработку персональных данных должно быть принято',
        ];
    }
}
