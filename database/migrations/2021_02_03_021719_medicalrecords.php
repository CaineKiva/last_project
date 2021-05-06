<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Medicalrecords extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('medicalrecords', function (Blueprint $table) {
            $table->increments('medicalrecords_id');
            $table->timestamps();
            $table->integer('status');
            $table->float('price');
            $table->integer('patient_id')->unsigned();
            $table->integer('speciallist_id')->unsigned();
            $table->integer('doctor_id')->unsigned();
            $table->integer('medicine_id')->unsigned();
            $table->foreign('patient_id')->references('patient_id')->on('patient');
            $table->foreign('speciallist_id')->references('speciallist_id')->on('speciallist');
            $table->foreign('doctor_id')->references('doctor_id')->on('doctor');
            $table->foreign('medicine_id')->references('medicine_id')->on('medicine');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
// hospitalized_day
// discharge_day