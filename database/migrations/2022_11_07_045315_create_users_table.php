<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUsersTable extends Migration {

	public function up()
	{
		Schema::create('users', function(Blueprint $table) {
			$table->increments('id')->unique();
			$table->string('firstname', 225);
			$table->string('lastname', 225);
			$table->string('username', 225)->unique();
			$table->string('sex', 225)->nullable();
			$table->string('age')->nullable();
			$table->string('email', 225);
			$table->string('mobile_number', 225)->unique();
			$table->integer('roles');
			$table->DateTime('last_login');
			$table->string('account_number', 225);
			$table->string('account_name', 225);
			$table->string('bank_name', 225);
			$table->string('password', 225);
			$table->timestamps();
			$table->softDeletes();
		});
	}

	public function down()
	{
		Schema::drop('users');
	}
}