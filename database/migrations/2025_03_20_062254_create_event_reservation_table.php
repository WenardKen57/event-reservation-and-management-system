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
        Schema::create('event_reservations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('event_name', 255)->nullable(false);
            $table->date('event_date')->nullable(false);
            $table->time('event_time')->nullable(false);
            $table->string('event_location', 255)->nullable(false);
            $table->integer('event_package_id')->nullable(false);
            $table->decimal('total_price', 10, 2);
            $table->integer('guest')->default(0);
            $table->text('special_request')->nullable();
            $table->enum('status', ['pending', 'cancelled', 'approved', 'disapproved', 'completed'])->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('event_reservations');
    }
};
