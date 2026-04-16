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
            $table->string('payment_wallet_address')->nullable()->after('active');
            $table->string('payment_qr_code')->nullable()->after('payment_wallet_address');
            $table->text('payment_instructions')->nullable()->after('payment_qr_code');
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
            $table->dropColumn(['payment_wallet_address', 'payment_qr_code', 'payment_instructions']);
        });
    }
};
