<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class Subject_teacher extends Model
{
    protected $table = 'subject_teacher';
    protected $fillable = ['id_teacher','id_subject'];
    public $timestamps = false;
    public function Teacher()
    {
        return $this->belongsTo('App\Models\Teacher', 'id_teacher');
    }
    public function Subject()
    {
        return $this->belongsTo('App\Models\Subject', 'id_subject');
    }
    // function scopeGetFullName($query)
    // {
    //     return $query->addSelect(DB::raw('CONCAT() AS full_name_ajax_subject'));
    // }
}
