<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
// use CoenJacobs\EloquentCompositePrimaryKeys\HasCompositePrimaryKey;



class Medicalrecords extends Model
{
    // use HasCompositePrimaryKey;

    protected $table = 'medicalrecords';
	protected $primaryKey = 'medicalrecords_id';
	protected $fillable = ['medicalrecords_id','hospitalized_day','discharge_day','status','price','patient_id','speciallist_id','doctor_id','medicine_id'];
	public $timestamps = [ "created_at", "updated_at" ];
	public function Doctor()
    {
    	return $this->belongsTo('App\Models\Doctor','doctor_id');
    }
    public function Patient()
    {
    	return $this->belongsTo('App\Models\Patient','patient_id');
    }
    public function Speciallist()
    {
    	return $this->belongsTo('App\Models\Speciallist','speciallist_id');
    }
     public function Medicine()
    {
    	return $this->belongsTo('App\Models\Medicine', 'medicine_id');
    }
    //  public function Discipline()
    // {
    // 	return $this->belongsTo('App\Models\Discipline', 'id');
    // }
    // protected function setKeysForSaveQuery(Builder $query)
    // {
    //     $keys = $this->getKeyName();
    //     if(!is_array($keys)){
    //         return parent::setKeysForSaveQuery($query);
    //     }

    //     foreach($keys as $keyName){
    //         $query->where($keyName, '=', $this->getKeyForSaveQuery($keyName));
    //     }

    //     return $query;
    // }
    // protected function getKeyForSaveQuery($keyName = null)
    // {
    //     if(is_null($keyName)){
    //         $keyName = $this->getKeyName();
    //     }

    //     if (isset($this->original[$keyName])) {
    //         return $this->original[$keyName];
    //     }

    //     return $this->getAttribute($keyName);
    // }
     
}
