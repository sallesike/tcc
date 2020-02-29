<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Certificate extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('certificate', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('harnessing');//aproveitamento      
            $table->string('code_certificate')->unique();//codigo de validação do certificado

            $table->unsignedBigInteger('subscription_id'); 
            $table->unsignedBigInteger('user_id'); 
            $table->unsignedBigInteger('tb_event_id'); 

            $table->foreign('subscription_id')->references('id')->on('subscription');
            $table->foreign('user_id')->references('id')->on('user');
            $table->foreign('tb_event_id')->references('id')->on('tb_event');
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
        Schema::table('certificate', function($table)
        {
            Schema::drop('certificate');
            $table->dropForeign('subscription_id');
        });
    }
}
