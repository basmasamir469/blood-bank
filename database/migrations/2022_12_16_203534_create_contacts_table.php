<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateContactsTable extends Migration {

	public function up()
	{
		Schema::create('contacts', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->softDeletes();
			$table->string('name', 191);
			$table->string('email', 191);
			$table->string('phone', 191);
			$table->string('subject', 191);
			$table->longText('message');
		});
	}

	public function down()
	{
		Schema::drop('contacts');
	}
}