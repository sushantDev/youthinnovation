<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreNews extends FormRequest
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
            'quote'            => $this->get('quote'),
            'title'            => $this->get('title'),
            'body'            => $this->get('body'),


        ];

        return $data;
    }
}
