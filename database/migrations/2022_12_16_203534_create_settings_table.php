<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSettingsTable extends Migration {

	public function up()
	{
		Schema::create('settings', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->softDeletes();
			$table->text('notification_settings_text')->nullable();
			$table->text('about_app');
			$table->text('intro')->nullable();
			$table->text('conclusion')->nullable();
			$table->string('phone', 191);
			$table->string('email', 191);
			$table->string('fb_link', 191)->nullable();
			$table->string('tw_link', 191)->nullable();
			$table->string('insta_link', 191)->nullable();
		});
	}

	public function down()
	{
		Schema::drop('settings');
	}
}