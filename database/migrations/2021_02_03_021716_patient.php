<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Patient extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patient', function (Blueprint $table) {
            $table->increments('patient_id');
            $table->string('first_name',50);
            $table->string('last_name',50);
            $table->date('birthday');
            $table->boolean('gender');
            $table->text('address');
            $table->string('contact_phone',15);
            $table->string('email',50)->nullable();
            $table->string('password',250);
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
