<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Speciallist extends Model
{
   protected $table = 'speciallist';
   protected $primaryKey = 'speciallist_id'; 
   protected $fillable = ['speciallist_name'];  
   public $timestamps = false; 
}
