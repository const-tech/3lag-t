<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLabRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lab_requests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('doctor_id')->nullable()->constrained('users','id')->nullOnDelete();
            $table->foreignId('patient_id')->constrained('patients','id')->cascadeOnDelete();
            $table->foreignId('clinic_id')->nullable()->constrained('departments','id')->nullOnDelete();
            $table->foreignId('appointment_id')->nullable()->constrained('appointments','id')->nullOnDelete();
            $table->foreignId('lab_id')->nullable()->constrained('labs','id')->nullOnDelete();
            $table->foreignId('category_id')->constrained('lab_categories','id')->cascadeOnDelete();
            $table->foreignId('service_id')->constrained('services','id')->cascadeOnDelete();
            $table->text('dr_content')->nullable();
            $table->string('status')->default('pending');
            $table->text('lab_content')->nullable();
            $table->string('file')->nullable();
            $table->date('delivered_at')->nullable();
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
        Schema::dropIfExists('lab_requests');
    }
}
