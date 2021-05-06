<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Hash;
use DB;

class Nurse extends Model
{
    protected $table = 'nurse'; // kết nối bảng lớp
    protected $primaryKey = 'nurse_id'; // đổi khóa chính thành id

    protected $fillable = ['first_name','last_name','birthday','address','phone','email','gender','password','competence_id']; //khai báo cột cần 
    public function Competence()
    {
        return $this->belongsTo('App\Models\Competence', 'competence_id');
    }
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
