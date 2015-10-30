<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePhotoByTagTabel extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('PhotoByTag', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('tag');
			$table->string('username');
			$table->string('photoId');
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
		Schema::drop('PhotoByTag');
	}

}
