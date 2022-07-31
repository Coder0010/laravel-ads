<?php

namespace MKamelMasoud\Ads\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        $uniqueRule = 'unique:categories,name' . (request('category') ? ",$this->category" : '');

        return [
            'name' => [
                'required',
                'string',
                $uniqueRule
            ],
            'description' => [
                'nullable',
                'string',
            ]
        ];
    }
}
