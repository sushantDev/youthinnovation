<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreWhat extends FormRequest
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
            'facts'            => $this->get('facts'),
            'data'            => $this->get('data'),
            'spirit'            => $this->get('spirit'),
            'strategy'            => $this->get('strategy'),
            'advocacy'            => $this->get('advocacy'),
        ];

        return $data;
    }
}
