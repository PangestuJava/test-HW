<?php

namespace App\Http\Requests\Store;

use Illuminate\Foundation\Http\FormRequest;

class BookStoreRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'category_id' => ['required', 'max:1'],
            'title' => ['required', 'string', 'max:255'],
        ];
    }

    public function attributes()
    {
        return [
            'category_id' => __('Category'),
        ];
    }
}
