<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Hash;

class Doctor extends Model
{
    protected $table = 'doctor'; // kết nối bảng lớp
    protected $primaryKey = 'doctor_id'; // đổi khóa chính thành id

    protected $fillable = ['first_name','last_name','birthday','address','email','phone','gender','password','speciallist_id','competence_id']; //khai báo cột cần 
    
    public function getFullNameAttribute(){
            return "{$this->first_name} {$this->last_name}";
        }
   
    public $timestamps = false; 
    public function setPasswordAttribute($password){

        $this->attributes['password'] = Hash::make($password);
    }
    // public function Subject()
    // {
    //     return $this->hasMany('App\Models\Subject', 'id_teacher', 'id');
    // }
    public function Speciallist()
    {
        return $this->belongsTo('App\Models\Speciallist', 'speciallist_id');
    }
    public function Competence()
    {
        return $this->belongsTo('App\Models\Competence', 'competence_id');
    }
}
