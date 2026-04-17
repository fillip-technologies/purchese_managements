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
        Schema::create('stock_movements', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('product_id');

            $table->enum('movement_type', ['in', 'out']);
            $table->decimal('quantity', 10, 2)->nullable();

            $table->string('reference_type')->nullable(); // PO, Dispatch, etc
            $table->unsignedBigInteger('reference_id')->nullable();

            $table->text('remarks')->nullable();
            $table->timestamps();

            $table->foreign('product_id')
                ->references('id')->on('products')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stock_movements');
    }
};
