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
        Schema::create('employees_commission', function (Blueprint $table) {
            $table->char('emp_id', 36);
            $table->date('month_year');
            $table->integer('total_commission');

            $table->foreign('emp_id')
                  ->references('emp_id')
                  ->on('employees')
                  ->onDelete('cascade');

            $table->primary(['emp_id', 'month_year']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees_commission');
    }
};
