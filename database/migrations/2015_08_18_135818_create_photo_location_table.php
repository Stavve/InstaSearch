<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePhotoLocationTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('PhotosByLocation', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('city');
			$table->string('username');
			$table->string('photoId');
			$table->string('comment');
			$table->string('likes');
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
		Schema::drop('PhotosByLocation');
	}

}
