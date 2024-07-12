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
            'image' => 'image|mimes:jpeg,png,jpg|max:2048',
        ];
    }

    public function messages()
    {
        return [
            'image.image' => 'Ảnh danh mục phải là một tệp hình ảnh hợp lệ!',
            'image.mimes' => 'Ảnh danh mục đại diện phải có định dạng: jpeg, png, jpg!',
            'image.max' => 'Kích thước ảnh danh mục đại diện không được vượt quá 2MB!',
        ];
    }
}
