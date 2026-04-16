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
        Schema::create('card_categories', function(Blueprint $table) {
			$table->increments('id')->unique();
			$table->string('logo', 225);
			$table->string('card_name', 225);
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('card_categories');
	}
};