<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddServiceIdToScanRequests extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('scan_requests', function (Blueprint $table) {
            $table->foreignId('service_id')->nullable()->constrained('scan_services','id')->cascadeOnDelete();
            $table->text('content')->nullable()->change();
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
            $table->dropConstrainedForeignId('service_id');
            $table->dropColumn('service_id');
            $table->text('content')->nullable(false)->change();
        });
    }
}
