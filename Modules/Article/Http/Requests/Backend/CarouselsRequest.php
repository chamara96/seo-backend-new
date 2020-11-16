<?php

namespace Modules\Article\Http\Requests\Backend;

use Illuminate\Foundation\Http\FormRequest;

class CarouselsRequest extends FormRequest
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
            'title'         => 'required|max:191',
            'web_url'       => 'max:191',
            'image_url'     => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ];
    }
}
