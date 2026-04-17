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
       Schema::create('purchase_bills', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('purchase_order_id')->nullable();
        $table->unsignedBigInteger('vendor_id')->nullable();

        $table->string('bill_no')->nullable();
        $table->date('bill_date')->nullable();

        $table->decimal('bill_amount', 12, 2)->nullable();
        $table->decimal('gst_amount', 12, 2)->nullable();
        $table->decimal('total_amount', 12, 2)->nullable();

        $table->string('bill_file')->nullable();
        $table->timestamps();

        $table->foreign('purchase_order_id')
              ->references('id')->on('purchase_orders')
              ->onDelete('set null');

        $table->foreign('vendor_id')
              ->references('id')->on('vendors')
              ->onDelete('set null');
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('purchase_bills');
    }
};
