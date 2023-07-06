<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddStatusToInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('invoices', function (Blueprint $table) {
//            $table->foreignId('dr_id')->nullable()->constrained('users','id')->nullableOnDelete();
//            $table->enum('status',['paid','unpaid']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('invoices', function (Blueprint $table) {
            $table->dropColumn('status');
            $table->dropConstrainedForeignId('dr_id');
            $table->dropColumn('dr_id');
        });
    }
}
