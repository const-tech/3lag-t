<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAppointmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('patient_id');
            $table->unsignedInteger('employee_id');
            $table->unsignedInteger('doctor_id');
            $table->unsignedInteger('clinic_id');
            $table->string('appointment_number');
            $table->string('appointment_type')->nullable();
            $table->string('appointment_status')->default('pending');
            $table->string('appointment_reason')->nullable();
            $table->string('appointment_note')->nullable();
            $table->string('appointment_time')->nullable();
            $table->string('appointment_date')->nullable();
            $table->string('appointment_duration')->nullable();
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
        Schema::dropIfExists('appointments');
    }
}
