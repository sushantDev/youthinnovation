<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateMainProject extends FormRequest
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
            'image'       => 'image|max:2048'
        ];
    }

    public function data()
    {
        $data = [
            'author'            => $this->get('author'),
            'moto'            => $this->get('moto'),
            'title'            => $this->get('title'),
            'about_title'            => $this->get('about_title'),
            'title_description'            => $this->get('title_description'),
            'problem_context'            => $this->get('problem_context'),
            'problem_description'            => $this->get('problem_description'),
        ];

        return $data;
    }
}
