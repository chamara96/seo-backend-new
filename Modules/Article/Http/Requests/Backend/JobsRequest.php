<?php

namespace Modules\Article\Http\Requests\Backend;

use Illuminate\Foundation\Http\FormRequest;

class JobsRequest extends FormRequest
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
            'jobtitle'          => 'required|max:191',
            'intro'             => 'required',
            'content'           => 'required',
            'status'            => 'required',
            'type'              => 'required|max:191',
            // 'featured_image'    => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            // 'question_1'         => 'text|max:191',
            // 'question_2'         => 'text|max:191',
            // 'question_3'         => 'text|max:191',
            // 'question_4'         => 'text|max:191',
            // 'question_5'         => 'text|max:191',
            // 'question_6'         => 'text|max:191',
            // 'answers_1'         => 'text|max:191',
            // 'answers_2'         => 'text|max:191',
            // 'answers_3'         => 'text|max:191',
            // 'answers_4'         => 'text|max:191',
            // 'answers_5'         => 'text|max:191',
            // 'answers_6'         => 'text|max:191',
        ];
    }
}
