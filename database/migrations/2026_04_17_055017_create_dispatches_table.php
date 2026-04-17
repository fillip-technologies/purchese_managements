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
        Schema::create('dispatches', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('purchase_order_id')->nullable();

            $table->dateTime('dispatch_date')->nullable();
            $table->string('transport_mode')->nullable();
            $table->string('vehicle_no')->nullable();
            $table->string('driver_name')->nullable();
            $table->string('driver_phone')->nullable();

            $table->string('from_location')->nullable();
            $table->string('to_location')->nullable();

            $table->decimal('transport_cost', 12, 2)->nullable();
            $table->text('remarks')->nullable();
            $table->string('dispatch_photo')->nullable();

            $table->unsignedBigInteger('created_by')->nullable();
            $table->timestamps();

            $table->foreign('purchase_order_id')
                ->references('id')->on('purchase_orders')
                ->onDelete('set null');

            $table->foreign('created_by')
                ->references('id')->on('users')
                ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dispatches');
    }
};
