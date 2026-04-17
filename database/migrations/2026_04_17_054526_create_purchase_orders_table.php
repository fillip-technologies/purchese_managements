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
        Schema::create('purchase_orders', function (Blueprint $table) {
            $table->id();
            $table->string('po_number')->unique()->nullable();

            $table->unsignedBigInteger('requisition_id')->nullable();
            $table->unsignedBigInteger('vendor_id')->nullable();
            $table->unsignedBigInteger('client_id')->nullable();
            $table->unsignedBigInteger('approved_by')->nullable();

            $table->decimal('subtotal', 12, 2)->nullable();
            $table->decimal('gst_amount', 12, 2)->nullable();
            $table->decimal('total_amount', 12, 2)->nullable();

            $table->enum('status', [
                'pending_approval',
                'approved',
                'sent_to_vendor',
                'in_progress',
                'dispatched',
                'completed',
            ])->default('pending_approval');

            $table->timestamps();

            $table->foreign('requisition_id')
                ->references('id')->on('purchase_requisitions')
                ->onDelete('set null');

            $table->foreign('vendor_id')
                ->references('id')->on('vendors')
                ->onDelete('set null');

            $table->foreign('client_id')
                ->references('id')->on('clients')
                ->onDelete('set null');

            $table->foreign('approved_by')
                ->references('id')->on('users')
                ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('purchase_orders');
    }
};
