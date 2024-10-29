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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('customer_id'); // Update from 'user_id' to 'customer_id'
            $table->foreign('customer_id')->references('id')->on('users')->onDelete('cascade'); // Ensure the foreign key is correct
            $table->unsignedBigInteger('product_id'); // Add the product_id foreign key
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade'); // Ensure the foreign key is correct
            $table->decimal('total_price', 10, 2);
            $table->string('image')->nullable();
            // Define the 'order_status' as an ENUM type with specific values
            $table->enum('order_status', ['pending', 'processing',  'delivered', 'cancelled'])->default('pending');
            $table->integer('quantity')->default(1); // Default to 1 or set to whatever makes sense

            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
