<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DetailKeyRequest extends FormRequest
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
        $langs = \Config::get('global.langs');

        return [
            'title.' . current($langs)->getId() => 'required',
            'category' => 'required|exists:detail_categories,id',
            'highlighted' => 'required|boolean'
        ];
    }
}
