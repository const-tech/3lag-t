<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DeleteColumnsFromLabRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('lab_requests', function (Blueprint $table) {
            $table->dropForeign(['service_id']);
            $table->dropColumn(['service_id']);
            $table->dropForeign(['lab_id']);
            $table->dropColumn(['lab_id']);
            $table->dropForeign(['category_id']);
            $table->dropColumn(['category_id']);
            $table->foreignId('product_id')->nullable()->constrained('products','id')->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('lab_requests', function (Blueprint $table) {
            //
        });
    }
}
