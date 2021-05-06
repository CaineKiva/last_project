<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Competence extends Model
{
   protected $table = 'competence';
   protected $primaryKey = 'competence_id'; 
   protected $fillable = ['competence_name'];  
   public $timestamps = false; 
}
