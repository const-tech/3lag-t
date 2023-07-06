<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('invoices', function (Blueprint $table) {
            $table->foreignId('dr_id')->nullable()->constrained('users','id')->nullOnDelete();
            $table->foreignId('department_id')->nullable()->constrained('departments','id')->nullOnDelete();
            $table->float('amount',10,2)->default(0);
            $table->float('cash',10,2)->default(0);
            $table->float('card',10,2)->default(0);
            $table->float('rest',10,2)->default(0);
            $table->text('notes')->nullable();
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
            $table->dropConstrainedForeignId('dr_id');
            $table->dropConstrainedForeignId('department_id');
            $table->dropColumn('department_id');
            $table->dropColumn('dr_id');
            $table->dropColumn('amount');
            $table->dropColumn('cash');
            $table->dropColumn('card');
            $table->dropColumn('rest');
            $table->dropColumn('notes');
        });
    }
}
