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
        Schema::create('pricing_orders', function (Blueprint $table) {
            $table->id();
            $table->string('distance');
            $table->string('price');
            $table->unsignedBigInteger('location_start_id')->nullable();
            $table->unsignedBigInteger('location_finish_id')->nullable();
            $table->foreign("location_start_id")->references("id")->on("locations")->nullOnDelete();
            $table->foreign("location_finish_id")->references("id")->on("locations")->nullOnDelete();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pricing_orders');
    }
};
