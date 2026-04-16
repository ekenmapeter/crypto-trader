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
        if (!Schema::hasTable('wallet_type')) {
            Schema::create('wallet_type', function (Blueprint $table) {
                $table->increments('id');
                $table->string('logo')->nullable();
                $table->string('coin_name')->nullable();
                $table->string('short_code')->nullable();
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('wallet_type');
    }
};
