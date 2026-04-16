<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateWalletTable extends Migration {

	public function up()
	{
		Schema::create('wallets', function(Blueprint $table) {
			$table->increments('id');
			$table->string('user_id');
			$table->float('amount');
			$table->timestamps();
			$table->softDeletes();
		});
	}

	public function down()
	{
		Schema::drop('wallets');
	}
}