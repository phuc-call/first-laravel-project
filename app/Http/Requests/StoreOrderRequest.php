<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreOrderRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true; // Bạn có thể thay đổi điều này nếu cần
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            // User ID phải là số nguyên dương và tồn tại trong bảng users
            'user_id' => 'required',

            // Tên người nhận phải có ít nhất 3 ký tự và không quá 255 ký tự
            'name' => 'required|string|min:3|max:255',

            // Số điện thoại phải là số và có độ dài hợp lý
            'phone' => 'required|string|min:10|max:15',

            // Email phải là email hợp lệ
            'email' => 'required|email|max:255',

            // Địa chỉ phải không quá 1000 ký tự
            'address' => 'required|string|max:1000',

            // Trạng thái phải là một trong hai giá trị: 0 (Không xuất bản) hoặc 1 (Xuất bản)
            'status' => 'required|in:0,1',
        ];
    }

    /**
     * Get the custom messages for validation errors.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'user_id.required' => 'User ID là bắt buộc.',
            'name.required' => 'Tên người nhận là bắt buộc.',
            'name.string' => 'Tên người nhận phải là một chuỗi ký tự.',
            'name.min' => 'Tên người nhận phải có ít nhất 3 ký tự.',
            'name.max' => 'Tên người nhận không được vượt quá 255 ký tự.',
            'phone.required' => 'Số điện thoại là bắt buộc.',
            'phone.string' => 'Số điện thoại phải là một chuỗi ký tự.',
            'phone.min' => 'Số điện thoại phải có ít nhất 10 ký tự.',
            'phone.max' => 'Số điện thoại không được vượt quá 15 ký tự.',
            'email.required' => 'Email là bắt buộc.',
            'email.email' => 'Email phải hợp lệ.',
            'email.max' => 'Email không được vượt quá 255 ký tự.',
            'address.required' => 'Địa chỉ là bắt buộc.',
            'address.string' => 'Địa chỉ phải là một chuỗi ký tự.',
            'address.max' => 'Địa chỉ không được vượt quá 1000 ký tự.',
            'status.required' => 'Trạng thái là bắt buộc.',
            'status.in' => 'Trạng thái phải là 0 (Không xuất bản) hoặc 1 (Xuất bản).',
        ];
    }
}
