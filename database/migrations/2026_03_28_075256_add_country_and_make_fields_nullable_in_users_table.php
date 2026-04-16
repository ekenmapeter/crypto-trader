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
        Schema::table('users', function (Blueprint $table) {
            if (!Schema::hasColumn('users', 'country')) {
                $table->string('country', 225)->nullable()->after('username');
            }
        });

        // Use raw SQL to change columns to nullable to avoid doctrine/dbal requirement in this environment
        DB::statement('ALTER TABLE users MODIFY last_login DATETIME NULL');
        DB::statement('ALTER TABLE users MODIFY account_number VARCHAR(225) NULL');
        DB::statement('ALTER TABLE users MODIFY account_name VARCHAR(225) NULL');
        DB::statement('ALTER TABLE users MODIFY bank_name VARCHAR(225) NULL');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('country');
        });
    }


};
