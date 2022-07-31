<?php

namespace MKamelMasoud\Ads\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TagRequest extends FormRequest
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
        $uniqueRule = 'unique_translation:tags,name' . (request('tag') ? ",$this->tag" : '');

        return [
            'name' => [
                'required',
                'string',
                $uniqueRule
            ],
        ];
    }
}
