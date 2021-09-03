<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDoctorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('doctors', function (Blueprint $table) {
            $table->id();
            $table->integer('clinic_id');
            $table->string('doctor_name');
            $table->string('short_description');
            $table->string('description')->nullable();
            $table->string('appointment_duration');
            $table->text('doctor_profile_image');
            $table->integer('mobile_no');
            $table->string('designation');
            $table->string('joining_date');
            $table->string('status');
            $table->string('type');
            $table->string('center');
            $table->string('expense')->nullable();
            $table->string('bank_charges')->nullable();
            $table->string('ayaan_percent')->nullable();
            $table->string('doctor_percent')->nullable();
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
        Schema::dropIfExists('doctors');
    }
}
