<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('verification_documents', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('verification_id');
            $table->string('type'); // front, back, selfie
            $table->string('path'); // storage path
            $table->timestamps();

            $table->foreign('verification_id')
                ->references('id')->on('user_verifications')
                ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('verification_documents');
    }
};


