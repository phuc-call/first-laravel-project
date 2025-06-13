<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTopicRequest extends FormRequest
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
            'name' => 'required|string|min:3|max:255',
            'slug' => 'required|string|min:3|max:255',


        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'Tên người nhận là bắt buộc.',
            'name.string' => 'Tên người nhận phải là một chuỗi ký tự.',
            'name.min' => 'Tên người nhận phải có ít nhất 3 ký tự.',
            'name.max' => 'Tên người nhận không được vượt quá 255 ký tự.',

            'slug.required' => 'Tên người nhận là bắt buộc.',
            'slug.string' => 'Tên người nhận phải là một chuỗi ký tự.',
            'slug.min' => 'Tên người nhận phải có ít nhất 3 ký tự.',
            'slug.max' => 'Tên người nhận không được vượt quá 255 ký tự.',
        ];
    }
}
