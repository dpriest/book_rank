<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddBooksAndRanksTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create('books', function(Blueprint $table){
            $table->increments('id');
            $table->string('name');
            $table->integer('mark');
            $table->integer('mark_users');
            $table->integer('rank_id')->nullable();
            $table->timestamps();
            $table->engine = 'MyISAM';
        });
        Schema::create('ranks', function($table){
            $table->increments('id');
            $table->string('name');
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
        Schema::drop('books');
        Schema::drop('ranks');
	}

}
