<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('transactions', function (Blueprint $table) {
            // Add new relevant columns for comprehensive transaction tracking
            // Only add columns that don't already exist
            if (!Schema::hasColumn('transactions', 'transaction_type')) {
                $table->string('transaction_type')->nullable()->after('status');
            }
            if (!Schema::hasColumn('transactions', 'reference_id')) {
                $table->string('reference_id')->nullable()->after('transaction_type');
            }
            if (!Schema::hasColumn('transactions', 'reference_type')) {
                $table->string('reference_type')->nullable()->after('reference_id');
            }
            if (!Schema::hasColumn('transactions', 'description')) {
                $table->text('description')->nullable()->after('reference_type');
            }
            if (!Schema::hasColumn('transactions', 'fee')) {
                $table->decimal('fee', 18, 8)->default(0)->after('description');
            }
            if (!Schema::hasColumn('transactions', 'currency')) {
                $table->string('currency')->default('USD')->after('fee');
            }
            if (!Schema::hasColumn('transactions', 'metadata')) {
                $table->json('metadata')->nullable()->after('currency');
            }
            if (!Schema::hasColumn('transactions', 'payment_method')) {
                $table->string('payment_method')->nullable()->after('metadata');
            }
            if (!Schema::hasColumn('transactions', 'payment_status')) {
                $table->string('payment_status')->default('pending')->after('payment_method');
            }
            if (!Schema::hasColumn('transactions', 'processed_at')) {
                $table->timestamp('processed_at')->nullable()->after('updated_at');
            }
            if (!Schema::hasColumn('transactions', 'admin_notes')) {
                $table->string('admin_notes')->nullable()->after('processed_at');
            }
            if (!Schema::hasColumn('transactions', 'user_notes')) {
                $table->string('user_notes')->nullable()->after('admin_notes');
            }
            if (!Schema::hasColumn('transactions', 'tx_hash')) {
                $table->string('tx_hash')->nullable()->after('user_notes');
            }
            if (!Schema::hasColumn('transactions', 'block_number')) {
                $table->string('block_number')->nullable()->after('tx_hash');
            }
            if (!Schema::hasColumn('transactions', 'from_address')) {
                $table->string('from_address')->nullable()->after('block_number');
            }
            if (!Schema::hasColumn('transactions', 'to_address')) {
                $table->string('to_address')->nullable()->after('from_address');
            }
            if (!Schema::hasColumn('transactions', 'exchange_rate')) {
                $table->decimal('exchange_rate', 18, 8)->nullable()->after('to_address');
            }
            if (!Schema::hasColumn('transactions', 'exchange_from_currency')) {
                $table->string('exchange_from_currency')->nullable()->after('exchange_rate');
            }
            if (!Schema::hasColumn('transactions', 'exchange_to_currency')) {
                $table->string('exchange_to_currency')->nullable()->after('exchange_from_currency');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('transactions', function (Blueprint $table) {
            $table->dropColumn([
                'transaction_type',
                'reference_id',
                'reference_type',
                'description',
                'fee',
                'currency',
                'metadata',
                'payment_method',
                'payment_status',
                'processed_at',
                'admin_notes',
                'user_notes',
                'tx_hash',
                'block_number',
                'from_address',
                'to_address',
                'exchange_rate',
                'exchange_from_currency',
                'exchange_to_currency'
            ]);
        });
    }
};
