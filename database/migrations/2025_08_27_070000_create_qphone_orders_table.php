<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('qphone_orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('user_id');
            $table->string('product_name');
            $table->string('product_image')->nullable();
            $table->decimal('price', 12, 2);
            $table->unsignedInteger('quantity')->default(1);
            $table->string('payment_coin')->nullable(); // wallet_type short_code
            $table->string('wallet_address')->nullable();
            $table->string('payment_proof')->nullable(); // uploaded receipt/screenshot
            $table->enum('status', ['pending','paid','approved','rejected'])->default('pending');
            $table->text('admin_notes')->nullable();
            $table->string('tx_reference')->nullable();
            $table->timestamp('paid_at')->nullable();
            $table->timestamp('approved_at')->nullable();
            $table->timestamp('rejected_at')->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('qphone_orders');
    }
};
