<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Hash;

class Appointment extends Model
{
    protected $table = 'appointment'; // kết nối bảng lớp
    protected $primaryKey = 'appointment_id'; // đổi khóa chính thành id

    protected $fillable = ['time','symptom','room','status','advice','doctor_id','speciallist_id','patient_id','medicine_id']; //khai báo cột cần

    public $timestamps = false;

    public function Speciallist()
    {
        return $this->belongsTo('App\Models\Speciallist', 'speciallist_id');
    }
    public function Doctor()
    {
        return $this->belongsTo('App\Models\Doctor', 'doctor_id');
    }
    public function Patient()
    {
        return $this->belongsTo('App\Models\Doctor', 'patient_id');
    }
}
