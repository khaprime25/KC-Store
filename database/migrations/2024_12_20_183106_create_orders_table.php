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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); 
            $table->foreignId('payment_id')->constrained('payments')->onDelete('cascade'); 
            $table->decimal('cart_total', 10, 2); 
            $table->tinyInteger('status')->default(0); 
            $table->string('transaction_id', 20);
            $table->string('phone_number', 15);
            $table->string('address');
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
