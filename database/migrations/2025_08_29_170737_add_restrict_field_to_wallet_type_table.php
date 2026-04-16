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
        Schema::table('wallet_type', function (Blueprint $table) {
            $table->decimal('restrict', 16, 8)->default(0.00000000)->after('payment_instructions');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('wallet_type', function (Blueprint $table) {
            $table->dropColumn('restrict');
        });
    }
};
