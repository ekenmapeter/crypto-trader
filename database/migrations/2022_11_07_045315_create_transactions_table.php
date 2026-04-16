<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration {

    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('user_id', 225);
            $table->string('fullname', 225);
            $table->decimal('amount', 10, 2); // Adjust the precision and scale accordingly
            $table->boolean('status');
            $table->string('card_type', 225)->nullable();
            $table->string('card_country_type', 225)->nullable();
            $table->integer('card_amount')->nullable();
            $table->integer('rate')->nullable();
            $table->string('logo', 225);
            $table->string('transaction_type')->nullable();
            $table->string('card1', 225)->nullable();
            $table->string('card2', 225)->nullable();
            $table->string('card3', 225)->nullable();
            $table->string('card4', 225)->nullable();
            $table->string('card5', 225)->nullable();
            $table->string('card6', 225)->nullable();
            $table->string('card7', 225)->nullable();
            $table->string('card8', 225)->nullable();
            $table->string('card9', 225)->nullable();
            $table->string('card10', 225)->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::drop('transactions');
    }
}
