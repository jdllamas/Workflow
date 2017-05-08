<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRequestTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('request', function (Blueprint $table) {
            //
			$table->increments('id');
			$table->string('title');
			$table->string('description');
			$table->dateTimeTz('date_requested');
			$table->dateTimeTz('date_closed');
			
			$table->integer('process_id')->unsigned();
			$table->integer('user_id')->unsigned();
			$table->timestamps();
			
			$table->foreign('process_id')->references('id')->on('process');
			$table->foreign('user_id')->references('id')->on('users');
			
			
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('request');
    }
}
