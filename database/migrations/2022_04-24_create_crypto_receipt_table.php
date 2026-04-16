<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('crypto-receipt', function(Blueprint $table) {
			$table->increments('id')->unique();
			$table->string('user_id', 225);
			$table->string('fullname', 225);
			$table->string('username', 225);
			$table->string('email', 225);
			$table->string('phone', 225);
			$table->string('coin_name', 225);
			$table->string('coin_id', 225);
			$table->string('coin_rate', 225);
			$table->string('status', 2);
			$table->string('receipt_upload', 225);
			$table->string('recieve_wallet_address');
			$table->string('amount', 225);
			$table->string('payout', 225);
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('crypto-receipt');
	}
};