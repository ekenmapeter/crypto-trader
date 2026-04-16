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
        Schema::table('withdrawals', function (Blueprint $table) {
            if (!Schema::hasColumn('withdrawals', 'wallet_type_id')) {
                $table->unsignedInteger('wallet_type_id')->after('user_id');
                $table->foreign('wallet_type_id')->references('id')->on('wallet_type')->onDelete('cascade');
            }
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('withdrawals', function (Blueprint $table) {
            if (Schema::hasColumn('withdrawals', 'wallet_type_id')) {
                $table->dropForeign(['wallet_type_id']);
                $table->dropColumn('wallet_type_id');
            }
        });
    }
};
