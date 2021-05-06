<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
        'password'          => 'required|min:8|Hash::check($rq->password, $admin->password)',
        'new_password'      => 'required|min:8',
        'confirm_password'  => 'required|same:new_password'
        ];
    }
    public function messages()
    {
        return [
        'required'   => 'Vui lòng điền :attribute',
        'password.min' => ':attribute tối thiểu phải có 8 ký tự',
        'new_password.min' => ':attribute tối thiểu phải có 8 ký tự',
        'confirm_password.same' => ':attribute không trùng khớp. Vui lòng xác minh lại mật khẩu',
        ];
    }
    public function attributes()
    {
        return [
        'password' => 'Mật khẩu hiện tại',
        'new_password' => 'Mật khẩu mới',
        'confirm_password' => 'Xác nhận mật khẩu',
        ];
    }
}
