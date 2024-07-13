<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserUpdateRequest extends FormRequest
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
            'last_name' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'birth_date' => 'required|date|before_or_equal:today',
            'image' => 'image|mimes:jpeg,png,jpg|max:2048',
            'phone' => 'required|string|min:10|max:11|regex:/^0[0-9]{9,10}$/',
            'email' => 'required|email',
        ];
    }

    public function messages()
    {
        return [
            'last_name.required' => 'Không được để trống họ và tên đệm!',
            'last_name.string' => 'Họ và tên đệm phải là chuỗi!',
            'last_name.max' => 'Họ và tên đệm không được vượt quá 255 kí tự!',
            'name.required' => 'Không được để trống tên!',
            'name.string' => 'Tên phải là chuỗi!',
            'name.max' => 'Tên không được vượt quá 255 kí tự!',
            'birth_date.required' => 'Không được để trống ngày sinh!',
            'birth_date.date' => 'Ngày sinh phải là định dạng ngày tháng!',
            'birth_date.before_or_equal' => 'Ngày sinh không được lớn hơn ngày hiện tại!',
            'image.image' => 'Ảnh đại diện phải là một tệp hình ảnh hợp lệ!',
            'image.mimes' => 'Ảnh đại diện đại diện phải có định dạng: jpeg, png, jpg!',
            'image.max' => 'Kích thước ảnh đại diện không được vượt quá 2MB!',
            'phone.required' => 'Không được để trống số điện thoại!',
            'phone.string' => 'Số điện thoại phải là chuỗi!',
            'phone.min' => 'Số điện thoại phải có ít nhất 10 kí tự!',
            'phone.max' => 'Số điện thoại không được vượt quá 11 kí tự!',
            'phone.regex' => 'Số điện thoại không hợp lệ!',
            'email.required' => 'Không được để trống địa chỉ email!',
            'email.email' => 'Địa chỉ email không hợp lệ!',
        ];
    }
}
