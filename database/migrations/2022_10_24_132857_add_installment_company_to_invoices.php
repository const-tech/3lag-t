<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddInstallmentCompanyToInvoices extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('invoices', function (Blueprint $table) {
            $table->boolean('installment_company')->default(false)->nullable();
            $table->double('installment_company_tax')->nullable();
            $table->double('installment_company_max_amount_tax')->nullable();
            $table->double('installment_company_min_amount_tax')->nullable();
            $table->double('installment_company_rest')->nullable();
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
            $table->dropColumn('installment_company');
            $table->dropColumn('installment_company_tax');
            $table->dropColumn('installment_company_max_amount_tax');
            $table->dropColumn('installment_company_min_amount_tax');
            $table->dropColumn('installment_company_rest');
        });
    }
}
