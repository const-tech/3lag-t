<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePatientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patients', function (Blueprint $table) {
            $table->id();
            $table->string('civil');
            $table->string('first_name');
            $table->string('parent_name')->nullable();
            $table->string('grand_name')->nullable();
            $table->string('last_name')->nullable();
            $table->foreignId('user_id')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('relationship_id')->nullable()->constrained('relationships')->nullOnDelete();
            $table->foreignId('department_id')->nullable()->constrained('departments')->nullOnDelete();
            $table->enum('gender',['male','female'])->default('male');
            $table->foreignId('city_id')->nullable()->constrained('cities','id')->nullOnDelete();
            $table->foreignId('country_id')->nullable()->constrained('countries','id')->nullOnDelete();
            $table->string('birthdate')->nullable();
            $table->string('age')->nullable();
            $table->string('phone')->nullable();
            $table->string('phone2')->nullable();
            $table->string('near_name')->nullable();
            $table->string('near_mobile')->nullable();
            $table->text('notes_health_record')->nullable();
            $table->text('goal_of_visit')->nullable();
            $table->boolean('penicillin')->nullable()->default(false);
            $table->boolean('teeth_problems')->nullable()->default(false);
            $table->boolean('drugs')->nullable()->default(false);
            $table->boolean('heart')->nullable()->default(false);
            $table->boolean('pressure')->nullable()->default(false);
            $table->boolean('fever')->nullable()->default(false);
            $table->boolean('anemia')->nullable()->default(false);
            $table->boolean('thyroid_glands')->nullable()->default(false);
            $table->boolean('liver')->nullable()->default(false);
            $table->boolean('sugar')->nullable()->default(false);
            $table->boolean('tb')->nullable()->default(false);
            $table->boolean('kidneys')->nullable()->default(false);
            $table->boolean('convulsion')->nullable()->default(false);
            $table->text('other_diseases')->nullable();
            $table->text('image')->nullable();
            $table->date('date')->nullable();
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
        Schema::dropIfExists('patients');
    }
}
