<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DeleteColumnsFromScanRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('scan_requests', function (Blueprint $table) {
            $table->dropColumn(['doctor_id']);
            $table->dropForeign(['service_id']);
            $table->dropColumn(['service_id']);
            $table->foreignId('product_id')->nullable()->constrained('products','id')->nullOnDelete();
            $table->foreignId('dr_id')->nullable()->constrained('users','id')->nullOnDelete();
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
            //
        });
    }
}
