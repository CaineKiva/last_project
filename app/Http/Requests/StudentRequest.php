<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StudentRequest extends FormRequest
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
            'first_name' =>  'required|regex:/^([a-zA-ZÀÁÂÃÈÉÊÌÍÒÓÔÕÙÚĂĐĨŨƠàáâãèéêìíòóôõùúăđĩũơƯĂẠẢẤẦẨẪẬẮẰẲẴẶẸẺẼỀỀỂưăạảấầẩẫậắằẳẵặẹẻẽềềểỄỆỈỊỌỎỐỒỔỖỘỚỜỞỠỢỤỦỨỪễệỉịọỏốồổỗộớờởỡợụủứừỬỮỰỲỴÝỶỸửữựỳỵỷỹ\s]+)$/i',
            'last_name' =>  'required|regex:/^([a-zA-ZÀÁÂÃÈÉÊÌÍÒÓÔÕÙÚĂĐĨŨƠàáâãèéêìíòóôõùúăđĩũơƯĂẠẢẤẦẨẪẬẮẰẲẴẶẸẺẼỀỀỂưăạảấầẩẫậắằẳẵặẹẻẽềềểỄỆỈỊỌỎỐỒỔỖỘỚỜỞỠỢỤỦỨỪễệỉịọỏốồổỗộớờởỡợụủứừỬỮỰỲỴÝỶỸửữựỳỵỷỹ\s]+)$/i',
            'email' => 'required|email',
            'date' => 'required',
            'address' => 'required' ,
            'phone' => 'required|numeric|regex:[0[0-9]{9}$]',
            'password' => 'required|min:8',
            'gender' => 'required|boolean',

        ];
    }
    public function messages()
    {
        return [
            'required' => 'Vui lòng điền :attribute',
            'first_name.regex' => ':attribute phải điền bằng chữ cái',
            'last_name.regex' => ':attribute phải điền bằng chữ cái',
            'phone' => 'Vui lòng điền :attribute',
            'phone.numeric' => ':attribute phải được điền bằng số',
            'phone.regex' => ':attribute phải có 10 chữ số, bắt đầu từ số 0',
            'email.email' => 'Vui lòng nhập đúng định dạng email (...@gmail.com)',
            // 'email.unique' => ':attribute đã tồn tại',
            'password.min' => ':attribute tối thiểu phải có 8 ký tự',
        ];
    }
    public function attributes()
    {
        return [
            'first_name' => 'Họ',
            'last_name' => 'Tên',
            'email' => 'Email',
            'date' => 'Ngày sinh',
            'password' => 'Mật khẩu',
            'phone' => 'Số điện thoại',
            'address' => 'Địa chỉ ',
            'gender' => 'Giới tính',
        ];
    }
}
