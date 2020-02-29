<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TbEvent extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_event', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 150);
            $table->date('date');            
            $table->string('address', 150);
            $table->string('status', 15);
            $table->integer('workload');
            $table->integer('min_workload');//porcentagem minima para gerar certificado
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
        Schema::table('tb_event', function($table)
        {
            Schema::drop('tb_event');
        });
    }
}
