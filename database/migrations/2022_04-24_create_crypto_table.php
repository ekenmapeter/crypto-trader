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
        Schema::create('crypto', function(Blueprint $table) {
			$table->increments('id')->unique();
			$table->string('logo', 225);
			$table->string('qr_code');
			$table->string('wallet_address');
			$table->string('coin_name', 225);
			$table->string('coin_rate', 225);
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('crypto');
	}
};