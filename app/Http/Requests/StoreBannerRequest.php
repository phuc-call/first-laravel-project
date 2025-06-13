<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBannerRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => [
                'required',
                'unique:banner,name', // ✅ đổi lại đúng bảng banner
                'min:3',
                'max:100',
                'regex:/^(?!\d+$)(?!.*\s{2,})[a-zA-Z0-9\sÀ-ỹà-ýÁ-ÝêôơêôưáÁíÍóÓúÚ]+$/'
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
            ],
            'image' => [
                'required'
            ]
        ];
    }

    public function messages(): array
    {
        return [
            'image.required' => 'Hình ảnh là bắt buộc.',
            'name.required' => 'Tên banner là bắt buộc.',
            'name.min' => 'Tên banner phải ít nhất 3 kí tự.',
            'name.max' => 'Tên banner không được nhiều hơn 100 ký tự.',
            'name.regex' => 'Tên banner không được chứa khoảng trắng liên tiếp, toàn số hoặc ký tự đặc biệt.',
            'name.unique' => 'Tên banner đã tồn tại.',

            'description.min' => 'Mô tả phải ít nhất 3 kí tự.',
            'description.max' => 'Mô tả phải ít hơn 500 kí tự.',
            'description.regex' => 'Mô tả không được chứa khoảng trắng liên tiếp, toàn số hoặc ký tự đặc biệt.',

            'sort_order.min' => 'Thứ tự phải lớn hơn hoặc bằng 0.',
            'sort_order.required' => 'Thứ tự là bắt buộc.',
            'sort_order.numeric' => 'Thứ tự phải là số.'
        ];
    }
}
