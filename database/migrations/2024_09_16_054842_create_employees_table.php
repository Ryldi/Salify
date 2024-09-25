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
        Schema::create('employees', function (Blueprint $table) {
            $table->char('emp_id', 36)->primary();
            $table->string('emp_firstName');
            $table->string('emp_lastName');
            $table->string('emp_address');
            $table->string('emp_role');
            $table->float('commission_rate', 0, 2);
            $table->date('hire_date');
            $table->date('resign_date')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
