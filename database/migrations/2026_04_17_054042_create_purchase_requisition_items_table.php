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
        Schema::create('purchase_requisition_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('requisition_id');
            $table->unsignedBigInteger('product_id');
            $table->decimal('quantity', 10, 2)->nullable();
            $table->string('unit')->nullable();
            $table->text('remarks')->nullable();
            $table->timestamps();

            $table->foreign('requisition_id')
                ->references('id')
                ->on('purchase_requisitions')
                ->onDelete('cascade');

            $table->foreign('product_id')
                ->references('id')
                ->on('products')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('purchase_requisition_items');
    }
};
