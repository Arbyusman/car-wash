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
        Schema::create('wash_transaction_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('wash_transaction_id')->constrained('wash_transactions');
            $table->foreignId('vehicle_id')->constrained('vehicles');
            $table->string('plate_number');
            $table->float('additional_cost');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('wash_transaction_details');
    }
};
