<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateClientsTable extends Migration {

	public function up()
	{
		Schema::create('clients', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->softDeletes();
			$table->string('email', 191);
			$table->string('password', 191);
			$table->string('name', 191);
			$table->date('d_o_b');
			$table->string('phone', 191);
			$table->date('last_donation_date');
			$table->string('pin_code', 191)->nullable();
			$table->integer('blood_type_id')->unsigned();
			$table->integer('city_id')->unsigned();
			$table->string('api_token',60)->unique()->nullable();

		});
	}

	public function down()
	{
		Schema::drop('clients');
	}
}