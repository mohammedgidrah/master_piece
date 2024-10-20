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
        // Creating a combined users/customers table
        Schema::create('users', function (Blueprint $table) {
            $table->id(); // This serves as both user_id and customer_id
            $table->string('first_name', 50)->nullable(); // For customers
            $table->string('last_name', 50)->nullable(); // For customers
            $table->string('email')->unique();
            $table->string('password'); // For users
            $table->enum('role', ['admin', 'user'])->default('user'); // Enum column for user roles
            $table->string('phone')->nullable(); // Optional for customers/users
            $table->string('address')->nullable(); // Optional for customers/users
            $table->timestamp('email_verified_at')->nullable(); // For email verification
            $table->string('image')->default('uploads/usersprofiles/defultimage/userimage.png'); // For profile/customer image
            $table->softDeletes(); // Adds the deleted_at column for soft delete functionality
            $table->rememberToken(); // Token for "remember me" sessions
            $table->timestamps(); // Created and updated timestamps
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
