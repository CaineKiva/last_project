<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Salary extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('salary', function (Blueprint $table) {
            $table->float('salary')->unsigned();
            $table->integer('speciallist_id')->unsigned();
            $table->integer('competence_id')->nullable()->unsigned();
            $table->primary([ 'speciallist_id' ]);
            $table->foreign('speciallist_id')->references('speciallist_id')->on('speciallist');
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
