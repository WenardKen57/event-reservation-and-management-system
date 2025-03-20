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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->nullable(false);
            $table->timestamp('transaction_date')->useCurrent();
            $table->decimal('total_amount', 10, 2)->nullable(true);
            $table->enum('transaction_status', ['pending', 'completed', 'cancelled'])
            ->default('pending');
            $table->string('reference_id', 50)->unique()->nullable(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
