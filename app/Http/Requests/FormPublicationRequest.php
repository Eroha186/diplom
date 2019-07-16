<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FormPublicationRequest extends FormRequest
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
    return [
        'files.*' => ['file', 'required|mimes:jpg,png,doc,docx,pdf,ppt,pptx'],
    ];
  }

  public function messages()
  {

    return [
        'files.required' => 'Не забудьте приложить файлы',
        'files.*.file' => 'Должен быть файл',
        'files.*.mime' => 'Не поддерживаемый формат',
    ];
  }
}
