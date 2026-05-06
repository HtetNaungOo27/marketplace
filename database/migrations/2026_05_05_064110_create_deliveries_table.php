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
        Schema::create('deliveries', function (Blueprint $table) {
            $table->id();

            $table->foreignId('order_id')->constrained()->cascadeOnDelete();

            // delivery staff is a USER (role = Delivery)
            $table->foreignId('delivery_staff_id')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            $table->string('tracking_number')->nullable();

            $table->enum('delivery_status', [
                'Preparing',
                'InTransit',
                'Delivered'
            ])->default('Preparing');

            $table->dateTime('delivery_date')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('deliveries');
    }
};
