<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('purchases', function (Blueprint $table) {
            $table->foreignId('employee_id')->nullable()->constrained('users', 'id')->cascadeOnDelete();
            $table->foreignId('last_update')->nullable()->constrained('users', 'id')->cascadeOnDelete();
        });

        Schema::table('services', function (Blueprint $table) {
            $table->foreignId('employee_id')->nullable()->constrained('users', 'id')->cascadeOnDelete();
            $table->foreignId('last_update')->nullable()->constrained('users', 'id')->cascadeOnDelete();
        });

        Schema::table('packages', function (Blueprint $table) {
            $table->foreignId('employee_id')->nullable()->constrained('users', 'id')->cascadeOnDelete();
            $table->foreignId('last_update')->nullable()->constrained('users', 'id')->cascadeOnDelete();
        });

        Schema::table('expenses', function (Blueprint $table) {
            $table->foreignId('employee_id')->nullable()->constrained('users', 'id')->cascadeOnDelete();
            $table->foreignId('last_update')->nullable()->constrained('users', 'id')->cascadeOnDelete();
        });
  
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
    }
};
