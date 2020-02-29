<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UserSchool extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('user_school', function (Blueprint $table) {
            
            $table->increments('id');     
            $table->unsignedBigInteger('user_id');     
            $table->unsignedBigInteger('school_id');

            $table->foreign('user_id')->references('id')->on('user');
            $table->foreign('school_id')->references('id')->on('school');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
         Schema::table('user_school', function($table)
        {
            Schema::drop('user_school');
            $table->dropForeign('user_id');
            $table->dropForeign('school_id');
        });
    }
}