<?php

namespace AdminDatabaseProvider\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class SearchRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
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
        return [
            'table'     => 'required|string',
            'columns'   => 'required|array',
            'values'    => 'required|array|equality:columns',
        ];
    }
}
