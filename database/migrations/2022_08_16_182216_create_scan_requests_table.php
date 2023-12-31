<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateScanRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('scan_requests', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('doctor_id');
            $table->unsignedInteger('patient_id');
            $table->unsignedInteger('clinic_id');
            $table->text('content');
            $table->string('status')->default('pending');
            $table->date('scanned_at')->nullable();
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
        Schema::dropIfExists('scan_requests');
    }
}
