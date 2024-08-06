<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DanhMucRequest extends FormRequest
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
            'ten_danh_muc' => 'required|max:255',

        ];
    }
    public function messages()
    {
        return [
            'ten_danh_muc.required' => 'Tên danh mục là bắt buộc',
            'ten_danh_muc.max:255' => 'Tên danh mục không được quá 255 ký tự',
        ];
    }
}
