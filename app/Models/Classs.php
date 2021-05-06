<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class Classs extends Model
{
    protected $table = 'class';
	protected $primaryKey = 'id';
	protected $fillable = ['name','id_discipline','id_course'];
	

	public $timestamps = false;
	
    public function Discipline()
    {
    	return $this->belongsTo('App\Models\Discipline', 'id_discipline');
    }
    public function Course()
    {
    	return $this->belongsTo('App\Models\Course', 'id_course');
    }
     
    public function getFullNameAttribute()
    {
        return "{$this->Discipline->name_collapse}{$this->name}{$this->Course->name_collapse}";
    }
    function scopeGetFullName($query)
    {
        return $query->addSelect(DB::raw('CONCAT(discipline.name_collapse,class.name,course.name_collapse) AS full_name_ajax'));
    }
}
