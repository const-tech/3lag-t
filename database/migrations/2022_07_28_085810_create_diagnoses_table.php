<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDiagnosesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('diagnoses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('appointment_id')->constrained('appointments','id')->cascadeOnDelete();
            $table->foreignId('patient_id')->constrained('patients','id')->cascadeOnDelete();
            $table->foreignId('dr_id')->constrained('users','id')->cascadeOnDelete();
            $table->foreignId('department_id')->constrained('departments','id')->cascadeOnDelete();
            $table->text('treatment');
            $table->text('taken');
            $table->string('tooth')->nullable();
            $table->string('time');
            $table->string('day');
            $table->enum('period',['morning','evening']);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('diagnoses');
    }
}
