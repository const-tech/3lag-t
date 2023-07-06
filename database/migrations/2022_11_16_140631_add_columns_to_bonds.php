<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToBonds extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('invoice_bonds', function (Blueprint $table) {
            $table->integer('user_id');
            $table->double('rest')->default(0)->nullable();
            $table->string('status')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('invoice_bonds', function (Blueprint $table) {
            $table->dropColumn('user_id');
            $table->dropColumn('rest');
            $table->dropColumn('status');
        });
    }
}
