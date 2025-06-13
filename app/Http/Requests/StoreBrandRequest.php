<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Symfony\Contracts\Service\Attribute\Required;

class StoreBrandRequest extends FormRequest
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
            'name' => [
                'required',
                'unique:category,name', //giữ thông tin
                'min:3',
                'max:100',
                'regex:/^(?!\d+$)(?!.*\s{2,})[a-zA-Z0-9\sÀ-ỹà-ýÁ-ÝêôơêôưáÁíÍóÓúÚ]+$/'
                // Cấm khoảng cách liên tiếp và không cho phép toàn số
            ],
            'description' => [
                'nullable',
                'regex:/^(?!\d+$)(?!.*\s{2,})[a-zA-Z0-9\sÀ-ỹà-ýÁ-ÝêôơêôưáÁíÍóÓúÚ]+$/',
                'max:500',
                'min:3'
            ],
            'sort_order' => [
                'required',
                'numeric',
                'min:0'
            ]
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'Tên danh mục là bắt buộc.',
            'name.min' => 'Tên sản phẩm phải ít nhất 3 kí tự.',
            'name.max' => 'Tên sản phẩm không được nhiều hơn 100 ký tự.',
            'name.regex' => 'Tên sản phẩm không được chứa khoảng cách liên tiếp, không được là số và kí tự đặt biệt.',
            'name.unique' => 'Tên đã tồn tại.',

            'description.min' => 'Mô tả sản phẩm phải ít nhất 3 kí tự.',
            'description.max' => 'Mô tả sản phẩm phải ít hơn 500 kí tự.',
            'description.regex' => 'Mô tả sản phẩm không được chứa khoảng cách liên tiếp, không được là số và kí tự đặt biệt.',


            'parent_id.min' => 'Parent_id phải bằng hoặc lớn hơn 0.',
            'parent_id.required' => 'parent_id là bắt buộc.',
            'parent_id.numeric' => 'Phải là số.',

            'sort_order.min' => 'sort_order phải bằng hoặc lớn hơn 0.',
            'sort_order.required' => 'sort_order là bắt buộc.',
            'sort_order.numeric' => 'Phải là số.',
        ];
    }
}
