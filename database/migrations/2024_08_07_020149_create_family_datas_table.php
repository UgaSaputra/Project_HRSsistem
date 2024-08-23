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
        Schema::create('family_datas', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('id_number');
            $table->string('mate_name')->nullable();
            $table->string('child_name')->nullable();
            $table->date('wedding_date')->nullable();
            $table->string('wedding_certificate_number')->nullable();
            $table->foreign('id_number')->references('id_number')->on('employees');
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
        Schema::dropIfExists('family_datas');
    }
};
