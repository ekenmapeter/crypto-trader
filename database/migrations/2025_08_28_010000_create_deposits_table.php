<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('deposits', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('user_id');
            $table->unsignedBigInteger('wallet_type_id');
            $table->decimal('amount', 20, 8)->nullable();
            $table->string('tx_reference')->nullable();
            $table->string('payment_proof')->nullable();
            $table->string('status')->default('pending'); // pending, approved, rejected
            $table->timestamp('credited_at')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('deposits');
    }
};


