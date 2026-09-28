<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            // 1 order cuma punya 1 pembayaran
            $table->foreignId('order_id')->unique()->constrained()->cascadeOnDelete();
            $table->enum('method', ['transfer', 'ewallet', 'cod']);
            $table->unsignedInteger('amount');
            $table->enum('status', ['unpaid', 'paid', 'failed'])->default('unpaid');
            $table->timestamp('paid_at')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
