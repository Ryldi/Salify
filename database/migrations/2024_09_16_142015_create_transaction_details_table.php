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
        Schema::create('transaction_details', function (Blueprint $table) {
            $table->char('transaction_id', 36);
            $table->char('service_id', 36);
            $table->char('emp_id', 36);
            $table->integer('service_price');
            $table->integer('service_quantity');
            $table->integer('post_commission');

            $table->foreign('transaction_id')
                  ->references('transaction_id')
                  ->on('transaction_headers')
                  ->onDelete('cascade');

            $table->foreign('service_id')
                  ->references('service_id')
                  ->on('services')
                  ->onDelete('cascade');

            $table->foreign('emp_id')
                  ->references('emp_id')
                  ->on('employees')
                  ->onDelete('cascade');

            $table->primary(['transaction_id', 'service_id', 'emp_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaction_details');
    }
};
