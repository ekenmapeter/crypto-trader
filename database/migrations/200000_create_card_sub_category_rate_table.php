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
        Schema::create('card_sub_categories_rate', function(Blueprint $table) {
        	$table->increments('id');
        	$table->unsignedInteger('card_id');
			$table->unsignedInteger('card_id_id');
			$table->string('card_country_name', 225);
			$table->double('rate',  8, 2);
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('card_sub_categories_rate');
	}
};