<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        try {
            Schema::table('wallet_link_requests', function (Blueprint $table) {
                $table->dropForeign(['wallet_type_id']);
            });
        } catch (\Exception $e) {
            // Continue if foreign key doesn't exist
        }

        DB::statement('ALTER TABLE wallet_link_requests CHANGE wallet_type_id wallet_provider_id INT(10) UNSIGNED NOT NULL');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement('ALTER TABLE wallet_link_requests CHANGE wallet_provider_id wallet_type_id INT(10) UNSIGNED NOT NULL');
    }
};
