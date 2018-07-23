<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreRating extends FormRequest
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
            'rad1'=>'required',
            'rad2'=>'required',
            'rad3'=>'required',
        ];
    }

    public function data()
    {
     return $data=[
            'rad1' =>$this->get('rad1'),
            'rad2' =>$this->get('rad2'),
            'rad3' =>$this->get('rad3'),
        ];
//       dd($data);

    }
}
