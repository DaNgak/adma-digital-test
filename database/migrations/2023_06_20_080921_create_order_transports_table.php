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
        Schema::create('order_transports', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('transport_id')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('pricing_order_id')->nullable();
            $table->string('total_passanger');
            $table->string('pickup_location');
            $table->enum('status', ['cancel', 'ongoing', 'finish'])->default('ongoing');
            $table->date('date_pickup');
            $table->unsignedBigInteger('location_start_id')->nullable();
            $table->unsignedBigInteger('location_finish_id')->nullable();
            $table->foreign("location_start_id")->references("id")->on("locations")->nullOnDelete();
            $table->foreign("location_finish_id")->references("id")->on("locations")->nullOnDelete();
            $table->foreign("user_id")->references("id")->on("users")->nullOnDelete();
            $table->foreign("transport_id")->references("id")->on("transports")->nullOnDelete();
            $table->foreign("pricing_order_id")->references("id")->on("pricing_orders")->nullOnDelete();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_transports');
    }
};
