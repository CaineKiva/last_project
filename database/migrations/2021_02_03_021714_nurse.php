<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Nurse extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nurse', function (Blueprint $table) {
            $table->increments('nurse_id');
            $table->string('first_name',50);
            $table->string('last_name',50);
            $table->date('birthday');
            $table->boolean('gender');
            $table->text('address');
            $table->string('email',50);
            $table->string('phone',15);
            $table->integer('competence_id')->unsigned();;
            $table->foreign('competence_id')->references('competence_id')->on('competence');
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
