<?php

namespace App\Http\Requests\Alert;

use Illuminate\Foundation\Http\FormRequest;

class AlertStoreRequest extends FormRequest
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
            'type' => 'required|numeric|in:2,4,8,16',
            'text' => 'required|max:1000',
            'distributionListID' => 'required|uuid'
        ];
    }
}
