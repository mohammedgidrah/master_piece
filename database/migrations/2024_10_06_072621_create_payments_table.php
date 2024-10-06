<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();  
            $table->foreignId('order_id')->constrained('orders')->onDelete('cascade');
            $table->string('payment_method', 50);
            $table->string('payment_status', 20);
            $table->decimal('amount', 10, 2);
            $table->string('transaction_id')->nullable();
            $table->timestamps();
        });
    }
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
