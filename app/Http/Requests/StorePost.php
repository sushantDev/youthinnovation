<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePost extends FormRequest {

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
            'title'   => 'required|max:200',
            'content' => 'required',
            'image'   => 'image|max:2048'
        ];
    }

    public function data()
    {
        $data = [
            'user_id'          => auth()->id(),
            'title'            => $this->get('title'),
            'meta_description' => $this->get('meta_description', null),
            'content'          => $this->get('content'),
            'view'             => empty($this->get('view')) ? 'post.full-width' : $this->get('view')
        ];

        return $data;
    }
}
