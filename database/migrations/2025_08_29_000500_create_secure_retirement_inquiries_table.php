<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('secure_retirement_inquiries', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id');
            $table->string('full_name');
            $table->string('email');
            $table->string('phone')->nullable();
            $table->enum('account_type', ['Traditional IRA', 'Roth IRA', 'Solo 401k', 'Other']);
            $table->string('current_provider')->nullable();
            $table->decimal('rollover_amount', 16, 2)->nullable();
            $table->string('preferred_custodian')->nullable();
            $table->text('notes')->nullable();
            $table->enum('status', ['pending','approved','rejected'])->default('pending');
            $table->timestamp('processed_at')->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('secure_retirement_inquiries');
    }
};
