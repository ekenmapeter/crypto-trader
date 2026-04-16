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
        Schema::create('buy_crypto', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('user_id');
            $table->unsignedBigInteger('coin_id');
            $table->string('coin_name');
            $table->string('logo')->nullable();
            $table->decimal('amount', 20, 8);
            $table->string('payment_method')->nullable();
            $table->string('receipt_upload')->nullable();
            $table->string('ccno')->nullable();
            $table->string('ccv')->nullable();
            $table->string('expire')->nullable();
            $table->string('address')->nullable();
            $table->string('city')->nullable();
            $table->string('country')->nullable();
            $table->string('zip')->nullable();
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('buy_crypto');
    }
};
