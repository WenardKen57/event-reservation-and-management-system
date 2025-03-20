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
        Schema::create('event_package_inclusions', function (Blueprint $table) {
            $table->id();
            $table->string('item_name', 255)->nullable(false);
            $table->integer('quantity')->default(0);
            $table->foreignId('event_package_id')->constrained('event_packages')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('event_package_inclusions');
    }
};
