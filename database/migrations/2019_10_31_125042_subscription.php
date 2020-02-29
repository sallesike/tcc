<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Subscription extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subscription', function (Blueprint $table) {
            $table->increments('id');
            $table->char('status', 1);
            $table->bigInteger('user_id')->unsigned();
            $table->bigInteger('tb_event_id')->unsigned();

            $table->foreign('user_id')->references('id')->on('user')->onDelete('cascade');
            $table->foreign('tb_event_id')->references('id')->on('tb_event')->onDelete('cascade');
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
        Schema::table('subscription', function($table)
        {
            Schema::drop('subscription');
            $table->dropForeign('user_id');
            $table->dropForeign('tb_event_id');
        });
    }
}