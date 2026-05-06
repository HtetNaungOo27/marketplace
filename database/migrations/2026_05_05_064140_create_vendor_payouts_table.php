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
        Schema::create('vendor_payouts', function (Blueprint $table) {
            $table->id();

            $table->foreignId('vendor_id')->constrained()->cascadeOnDelete();
            $table->foreignId('order_id')->constrained()->cascadeOnDelete();

            $table->decimal('gross_amount', 10, 2);
            $table->decimal('commission_rate', 5, 2);
            $table->decimal('commission_amount', 10, 2);
            $table->decimal('net_amount', 10, 2);

            $table->enum('payout_status', [
                'Pending',
                'Released'
            ])->default('Pending');

            $table->dateTime('payout_date')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vendor_payouts');
    }
};
