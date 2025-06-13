<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorPostRequests extends FormRequest
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
            'title' => 'required|string|min:3|max:255',
            'detail' => 'required',

        ];
    }
    public function messages()
    {
        return [
            'detail.required' => 'chi tiếtlà bắt buộc.',

            'title.required' => 'tiêu đề là bắt buộc.',
            'title.string' => 'tiêu đề phải là một chuỗi ký tự.',
            'title.min' => 'tiêu đề phải có ít nhất 3 ký tự.',
            'title.max' => 'tiêu đề không được vượt quá 255 ký tự.',
        ];
    }
}
