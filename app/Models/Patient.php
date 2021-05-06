<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Hash;
use DB;

class Patient extends Model
{
    protected $table = 'patient'; // kết nối bảng lớp
    protected $primaryKey = 'patient_id'; // đổi khóa chính thành id

    protected $fillable = ['first_name','last_name','birthday','address','contact_phone','email','gender','password']; //khai báo cột cần 
    public function getFullNameAttribute()
        {
            return "{$this->first_name} {$this->last_name}";
        }
    // function scopeGetFullName($query)
    // {
    //     return $query->addSelect(DB::raw('CONCAT(students.first_name,students.last_name) AS full_name_ajax_student'));
    // }
    // protected $attributes = [
    //     'level' => 3,
    //     'password' => 1,
    // ];
    public $timestamps = false; // chỉnh time chắc phải bắt buộc
    public function setPasswordAttribute($password){

        $this->attributes['password'] = Hash::make($password);
    }
}
