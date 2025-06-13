<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Symfony\Contracts\Service\Attribute\Required;

class StoreProductRequest extends FormRequest
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
                'required', //yêu cầu nhập

            ],
            'detail' => [
                'required',

            ],

            'price_root' => [
                'required',
            ],

            'price_sale' => [
                'nullable',

            ],

            'qty' => [
                'required',
                'min:1',
                'regex:/^(?!0(\.00?)?$)(?!0\d)[0-9]+(\.[0-9]{3})?$/', // Kiểm tra định dạng số
            ],
        ];
    }
    public function messages(): array
    {
        return [
            'name.required' => 'Tên sản phẩm là bắt buộc.',
            'name.unique' => 'Tên sản phẩm đã tồn tại.',
            'name.min' => 'Tên sản phẩm phải có ít nhất 3 ký tự.',
            'name.max' => 'Tên sản phẩm không được quá 100 ký tự.',
            'name.regex' => 'Tên sản phẩm không được chứa khoảng cách liên tiếp, không được là số và kí tự đặt biệt.',


            'detail.required' => 'Chi tiết sản phẩm là bắt buộc.',




            'price_root.required' => 'Giá gốc không được để trống.',
            'price_root.numeric' => 'Giá gốc phải là một số.',
            'price_root.min' => 'Giá gốc phải lớn hơn 0',
            'price_root.regex' => 'Giá gốc không được bắt đầu bằng số 0. Vui lòng nhập giá hợp lệ (ví dụ: 1000 hoặc 1.000).',

            'price_sale.lt' => 'Giá khuyến mãi phải nhỏ hơn hoặc bằng giá gốc.',
            'price_sale.numeric' => 'Giá khuyến mãi phải là một số.',
            'price_sale.min' => 'Nếu không giảm giá khì phải nhập không',
            'price_sale.regex' => 'Giá khuyến mãi không được bắt đầu bằng số 0. Vui lòng nhập giá hợp lệ (ví dụ: 1000 hoặc 1.000).',


            'qty.required' => 'Số lượng sản phẩm không được bỏ trống',
            'qty.min' => 'Số lượng sản phẩm không được nhỏ hơn 0',
            'qty.numeric' => 'Số lượng phải là một số',
            'qty.regex' => 'Số lượng không được bắt đầu bằng số 0. Vui lòng nhập giá hợp lệ (ví dụ: 1000 hoặc 1.000).',


        ];
    }
}
