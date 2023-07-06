<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('site_name')->nullable();
            $table->string('url')->nullable();
            $table->string('email')->nullable();
            $table->string('logo')->nullable();
            $table->string('icon')->nullable();
            $table->enum('status', ['open', 'close'])->default('open');
            $table->longtext('message_status')->nullable();
            $table->longtext('phone')->nullable();
            $table->enum('sms_status', ['open', 'close'])->default('open');
            $table->string('sms_username')->nullable();
            $table->string('sms_password')->nullable();
            $table->string('sms_sender')->nullable();
            $table->string('from_morning')->nullable();
            $table->string('to_morning')->nullable();
            $table->string('to_evening')->nullable();
            $table->string('from_evening')->nullable();
            $table->string('patient_exposure')->nullable();
            $table->string('address')->nullable();
            $table->string('build_num')->nullable();
            $table->string('unit_num')->nullable();
            $table->string('postal_code')->nullable();
            $table->string('extra_number')->nullable();
            $table->string('tax_no');
            $table->float('tax_rate')->default(0);
            $table->boolean('tax_enabled')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('settings');
    }
}
