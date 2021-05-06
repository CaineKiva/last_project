<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Appointment extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('appointment', function (Blueprint $table) {
            $table->increments('appointment_id');
            $table->datetime('time');
            $table->text('symptom');
            $table->String('room');
            $table->boolean('status');
            $table->integer('doctor_id')->unsigned();
            $table->integer('speciallist_id')->unsigned();
            $table->integer('patient_id')->unsigned();
            $table->foreign('doctor_id')->references('doctor_id')->on('doctor');
            $table->foreign('speciallist_id')->references('speciallist_id')->on('speciallist');
            $table->foreign('patient_id')->references('patient_id')->on('patient');
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
