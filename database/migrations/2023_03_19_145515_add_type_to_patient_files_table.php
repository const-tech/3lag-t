<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTypeToPatientFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('patient_files', function (Blueprint $table) {
            $table->enum('type', ['medical_files', 'sick_leave', 'prescription'])->default('medical_files');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('patient_files', function (Blueprint $table) {
            $table->dropColumn('type');
        });
    }
}
