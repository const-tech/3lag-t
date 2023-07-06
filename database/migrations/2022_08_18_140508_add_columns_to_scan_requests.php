<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToScanRequests extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('scan_requests', function (Blueprint $table) {
            $table->dropColumn('content');
            $table->text('dr_content')->nullable();
            $table->text('scan_content')->nullable();
            $table->foreignId('appointment_id')->nullable()->constrained('appointments','id')->nullOnDelete();
            $table->string('file')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('scan_requests', function (Blueprint $table) {
            $table->dropColumn('dr_content');
            $table->dropConstrainedForeignId('appointment_id');
            $table->dropColumn('appointment_id');
            $table->dropColumn('file');
        });
    }
}
