<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Hash;

class Admin extends Model
{
    protected $table = 'admin'; // kết nối bảng lớp
    protected $primaryKey = 'id'; // đổi khóa chính thành id

    protected $fillable = ['first_name','last_name','birthday','address','email','phone','gender','password']; //khai báo cột cần 

   
    public function getFullNameAttribute()
	{
		return "{$this->first_name} {$this->last_name}";
	}
    public $timestamps = false; // chỉnh time chắc phải bắt buộc
    public function setPasswordAttribute($password){

        $this->attributes['password'] = Hash::make($password);
    }
}
