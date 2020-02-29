<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFkInstructorToTbEvent extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tb_event', function (Blueprint $table) {
            $table->bigInteger('instructor_id')->unsigned()->nullable();
            $table->foreign('instructor_id')->references('id')->on('instructor');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tb_event', function (Blueprint $table) {
            //
        });
    }
}
