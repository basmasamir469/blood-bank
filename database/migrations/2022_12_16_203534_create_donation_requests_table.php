<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDonationRequestsTable extends Migration {

	public function up()
	{
		Schema::create('donation_requests', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->softDeletes();
			$table->string('patient_name', 191);
			$table->string('patient_phone', 191);
			$table->integer('city_id')->unsigned();
			$table->string('hospital_name', 191);
			$table->integer('blood_type_id')->unsigned();
			$table->string('patient_age', 191);
			$table->integer('bags_num');
			$table->string('hospital_address', 191);
			$table->text('details')->nullable();
			$table->decimal('longitude', 10,8);
			$table->decimal('latitude', 10,8);
			$table->integer('client_id')->unsigned();
		});
	}

	public function down()
	{
		Schema::drop('donation_requests');
	}
}