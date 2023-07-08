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
        Schema::create('package_days', function (Blueprint $table) {
            $table->id();
            $table->foreignId('patient_id')->constrained('patients', 'id')->cascadeOnDelete();
            $table->foreignId('patient_package_id')->nullable()->constrained()->cascadeOnDelete();
            $table->date('appointment_date');
            $table->string('appointment_time');
            $table->string('session_time');
            $table->string('status')->nullable();
            $table->timestamp('attend_at')->nullable();
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
        Schema::dropIfExists('package_days');
    }
};
