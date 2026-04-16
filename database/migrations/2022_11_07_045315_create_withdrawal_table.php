<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateWithdrawalTable extends Migration {

	public function up()
	{
		Schema::create('withdrawals', function(Blueprint $table) {
			$table->increments('id');
			$table->string('user_id', 225);
			$table->string('username', 225);
			$table->decimal('amount');
			$table->boolean('status');
			$table->string('account_number', 225);
			$table->string('account_name', 225);
			$table->string('bank_name', 225);
			$table->string('phone', 225);
			$table->softDeletes();
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('withdrawals');
	}
}