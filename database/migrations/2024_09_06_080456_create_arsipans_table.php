<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('arsipans', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('id_number')->unique();
            $table->string('full_name');
            $table->string('nickname')->nullable();
            $table->date('contract_date')->nullable();
            $table->date('work_date')->nullable();
            $table->date('date_fixed')->nullable();
            $table->string('status');
            $table->string('position');
            $table->string('nuptk')->nullable();
            $table->string('gender');
            $table->string('place_birth');
            $table->date('birth_date');
            $table->string('religion');
            $table->string('email')->nullable();
            $table->string('hobby')->nullable();
            $table->string('marital_status');
            $table->string('residence_address')->nullable();
            $table->string('phone')->nullable();
            $table->string('address_emergency')->nullable();
            $table->string('phone_emergency')->nullable();
            $table->string('blood_type')->nullable();
            $table->string('last_education')->nullable();
            $table->string('agency')->nullable();
            $table->integer('graduation_year')->nullable();
            $table->string('competency_training_place')->nullable();
            $table->string('organizational_experience')->nullable();
            $table->string('mate_name')->nullable();
            $table->string('child_name')->nullable();
            $table->date('wedding_date')->nullable();
            $table->string('wedding_certificate_number')->nullable();
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
        Schema::dropIfExists('arsipans');
    }
};
