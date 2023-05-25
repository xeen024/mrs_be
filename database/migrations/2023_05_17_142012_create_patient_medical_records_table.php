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
        Schema::create('patient_medical_records', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('patient_id');
            $table->unsignedBigInteger('doctor_id')->nullable();
            $table->foreign('patient_id')->references('id')->on('patients')->onDelete('cascade');
            $table->foreign('doctor_id')->references('id')->on('doctors')->onDelete('cascade');
            $table->string('type')->nullable();
            $table->string('status')->nullable();
            $table->string('phic_no')->nullable();
            $table->string('date_time')->nullable();
            $table->string('pr')->nullable();
            $table->string('rr')->nullable();
            $table->string('temp')->nullable();
            $table->string('bp')->nullable();
            $table->string('weight')->nullable();
            $table->string('height')->nullable();
            $table->string('bmi')->nullable();
            $table->string('waist')->nullable();
            $table->string('is_pedia')->nullable();
            $table->string('abd_circ')->nullable();
            $table->string('head_circ')->nullable();
            $table->string('cc')->nullable();
            $table->string('hpi')->nullable();
            $table->string('on_going_meds')->nullable();
            $table->string('pe')->nullable();
            $table->longText('assessment')->nullable();
            $table->longText('plan_diagnostics')->nullable();
            $table->longText('medications')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('patient_medical_records');
    }
};
