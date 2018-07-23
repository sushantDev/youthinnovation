<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FileRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     * @return array
     */
    public function rules()
    {
//        dd($this->all());
        return [
            'name'  => 'required|max:200',
            'email' => 'required',
            'reply' => 'required',
            'cv'    => 'mimetypes:application/pdf,application/vnd.openxmlformats-officedocument.wordprocessingml.document'
        ];
    }
}
