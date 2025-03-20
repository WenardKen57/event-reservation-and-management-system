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
        Schema::create('event_packages', function (Blueprint $table) {
            $table->id();
            $table->string('package_name', 255)->nullable(false);
            $table->text('description')->nullable(true);
            $table->decimal('total_price', 10, 2)->nullable(false);
            $table->enum('package_type', ['event', 'meal'])->nullable(false);
            $table->enum('event_type', ['wedding', 'birthday'])->nullable(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('event_packages');
    }
};
