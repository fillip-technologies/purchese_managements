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
        Schema::create('deliveries', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('dispatch_id')->nullable();

        $table->string('received_by_name')->nullable();
        $table->dateTime('received_date')->nullable();
        $table->string('drop_point')->nullable();

        $table->string('received_photo')->nullable();
        $table->string('receipt_file')->nullable();

        $table->text('remarks')->nullable();
        $table->timestamps();

        $table->foreign('dispatch_id')
              ->references('id')->on('dispatches')
              ->onDelete('cascade');
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('deliveries');
    }
};
