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
        Schema::create('purchase_requisitions', function (Blueprint $table) {
        $table->id();
        $table->string('req_no')->unique()->nullable();
        $table->unsignedBigInteger('client_id')->nullable();
        $table->string('project_name')->nullable();
        $table->unsignedBigInteger('requested_by')->nullable();
        $table->text('remarks')->nullable();

        $table->enum('status', [
            'draft',
            'submitted',
            'approved',
            'rejected',
            'po_created'
        ])->default('draft');

        $table->timestamps();

        $table->foreign('client_id')->references('id')->on('clients')->onDelete('set null');
        $table->foreign('requested_by')->references('id')->on('users')->onDelete('set null');
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('purchase_requisitions');
    }
};
