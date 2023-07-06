<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MakeAllColumnsNullInAppointmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('appointments', function (Blueprint $table) {
            $table->unsignedInteger('employee_id')->nullable()->change();
            $table->unsignedInteger('doctor_id')->nullable()->change();
            $table->unsignedInteger('clinic_id')->nullable()->change();
            $table->string('appointment_number')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('appointments', function (Blueprint $table) {
            $table->unsignedInteger('employee_id')->nullable(false)->change();
            $table->unsignedInteger('doctor_id')->nullable(false)->change();
            $table->unsignedInteger('clinic_id')->nullable(false)->change();
            $table->string('appointment_number')->nullable(false)->change();
        });
    }
}
