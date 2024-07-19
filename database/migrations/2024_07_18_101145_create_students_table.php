<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('middle_name')->nullable();
            $table->string('last_name');
            $table->string('admission_date');
            $table->text('student_photo');
            $table->string('dob');
            $table->string('gender');
            $table->string('email');
            $table->string('phone');
            $table->string('address');
            $table->unsignedBigInteger('country_id');
            $table->string('course');
            $table->string('father_name');
            $table->string('father_phone');
            $table->string('doument_text_1');
            $table->string('doument_image_1');
            $table->string('doument_text_2');
            $table->string('doument_image_2');
            $table->string('doument_text_3');
            $table->string('doument_image_3');
            $table->string('doument_text_4');
            $table->string('doument_image_4');
            $table->string('slug')->nullable();
            $table->integer('is_active')->default('1')->nullable()->comment('1:active, 0:inactive');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
