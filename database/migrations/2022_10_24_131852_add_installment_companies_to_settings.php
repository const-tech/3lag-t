<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddInstallmentCompaniesToSettings extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('settings', function (Blueprint $table) {
            $table->string('installment_company_name')->nullable();
            $table->float('installment_company_tax')->nullable();
            $table->float('installment_company_min_amount_tax')->nullable();
            $table->float('installment_company_max_amount_tax')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('settings', function (Blueprint $table) {
            $table->dropColumn('installment_company_name');
            $table->dropColumn('installment_company_tax');
            $table->dropColumn('installment_company_min_amount_tax');
            $table->dropColumn('installment_company_max_amount_tax');
        });
    }
}
