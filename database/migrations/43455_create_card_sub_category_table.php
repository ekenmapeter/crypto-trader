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
        Schema::create('card_sub_categories', function(Blueprint $table) {
			$table->increments('card_id')->unique();
			$table->string('card_logo', 225);
			$table->string('card_name', 225);
			$table->string('card_country_name', 225);
			$table->double('card_country_rate',  8, 2);
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('card_sub_categories');
	}
};