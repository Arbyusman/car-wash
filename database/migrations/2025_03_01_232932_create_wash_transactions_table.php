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
        Schema::create('wash_transactions', function (Blueprint $table) {
            $table->id();
            $table->string('transaction_number');
            $table->float('payment_amount');
            $table->float('change_amount');
            $table->float('total_cost');
            $table->boolean('is_printed')->default(false);
            $table->foreignId('washer_id')->constrained('washers');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('wash_transactions');
    }
};
