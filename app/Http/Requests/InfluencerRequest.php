<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Arr;

class InfluencerRequest extends FormRequest
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

        $rules = [
            //'user_id' => 'required',
        ];

        return $this->applyRules($rules);
    }

    /**
     * @param array $rules
     *
     * @return array
     */
    public function applyRules(array $rules): array
    {
        if ($this->isMethod('PATCH')) {
            return Arr::only($rules, $this->keys());
        }

        return $rules;
    }
}
