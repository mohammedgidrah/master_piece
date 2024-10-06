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
        Schema::create('reviews', function (Blueprint $table) {
            $table->id(); // review_id
            $table->unsignedBigInteger('product_id'); // Must match the type of the 'id' in 'categories'
            $table->unsignedBigInteger('customer_id'); // Must match the type of the 'id' in 'categories'
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            $table->foreign('customer_id')->references('id')->on('users')->onDelete('cascade');

            // $table->foreignId('product_id')->constrained('products')->onDelete('cascade');
            // $table->foreignId('customer_id')->constrained('customers')->onDelete('cascade');
            $table->tinyInteger('rating'); // e.g., 1-5 stars
            $table->text('comment')->nullable();
            $table->timestamps();
        });
    }
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reviews');
    }
};
