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
            // Add missing columns that the controller expects
            if (!Schema::hasColumn('withdrawals', 'method')) {
                $table->string('method')->after('wallet_type_id'); // crypto, bank, wire
            }
            if (!Schema::hasColumn('withdrawals', 'destination_address')) {
                $table->string('destination_address')->nullable()->after('method'); // for crypto
            }
            if (!Schema::hasColumn('withdrawals', 'wire_details')) {
                $table->text('wire_details')->nullable()->after('account_number');
            }
            if (!Schema::hasColumn('withdrawals', 'approved_at')) {
                $table->timestamp('approved_at')->nullable()->after('status');
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
            // Remove added columns
            if (Schema::hasColumn('withdrawals', 'method')) {
                $table->dropColumn('method');
            }
            if (Schema::hasColumn('withdrawals', 'destination_address')) {
                $table->dropColumn('destination_address');
            }
            if (Schema::hasColumn('withdrawals', 'wire_details')) {
                $table->dropColumn('wire_details');
            }
            if (Schema::hasColumn('withdrawals', 'approved_at')) {
                $table->dropColumn('approved_at');
            }
        });
    }
};
