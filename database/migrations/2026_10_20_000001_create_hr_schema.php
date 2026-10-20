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
        Schema::create('regions', function (Blueprint $table) {
            $table->id();
            $table->string('region_name')->nullable();
            $table->timestamps();
        });

        Schema::create('countries', function (Blueprint $table) {
            $table->char('country_id', 2)->primary();
            $table->string('country_name');
            $table->unsignedBigInteger('region_id')->nullable();
            $table->foreign('region_id')->references('id')->on('regions')->nullOnDelete();
            $table->timestamps();
        });

        Schema::create('locations', function (Blueprint $table) {
            $table->id();
            $table->string('street_address')->nullable();
            $table->string('postal_code')->nullable();
            $table->string('city');
            $table->string('state_province')->nullable();
            $table->char('country_id', 2);
            $table->foreign('country_id')->references('country_id')->on('countries')->cascadeOnUpdate()->restrictOnDelete();
            $table->timestamps();
        });

        Schema::create('jobs', function (Blueprint $table) {
            $table->id();
            $table->string('job_title');
            $table->decimal('min_salary', 10, 2)->nullable();
            $table->decimal('max_salary', 10, 2)->nullable();
            $table->timestamps();
        });

        Schema::create('departments', function (Blueprint $table) {
            $table->id();
            $table->string('department_name');
            $table->unsignedBigInteger('location_id')->nullable();
            $table->foreign('location_id')->references('id')->on('locations')->nullOnDelete();
            $table->timestamps();
        });

        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email')->unique();
            $table->string('phone_number')->nullable();
            $table->date('hire_date');
            $table->unsignedBigInteger('job_id');
            $table->decimal('salary', 12, 2);
            $table->decimal('commission_pct', 5, 2)->nullable();
            $table->unsignedBigInteger('manager_id')->nullable();
            $table->unsignedBigInteger('department_id')->nullable();
            $table->foreign('job_id')->references('id')->on('jobs')->restrictOnDelete();
            $table->foreign('manager_id')->references('id')->on('employees')->nullOnDelete();
            $table->foreign('department_id')->references('id')->on('departments')->nullOnDelete();
            $table->timestamps();
        });

        Schema::create('dependents', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('relationship');
            $table->unsignedBigInteger('employee_id');
            $table->foreign('employee_id')->references('id')->on('employees')->cascadeOnDelete();
            $table->timestamps();
        });

        Schema::create('job_history', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('employee_id');
            $table->date('start_date');
            $table->date('end_date')->nullable();
            $table->unsignedBigInteger('job_id');
            $table->unsignedBigInteger('department_id')->nullable();
            $table->foreign('employee_id')->references('id')->on('employees')->cascadeOnDelete();
            $table->foreign('job_id')->references('id')->on('jobs')->restrictOnDelete();
            $table->foreign('department_id')->references('id')->on('departments')->nullOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('job_history');
        Schema::dropIfExists('dependents');
        Schema::dropIfExists('employees');
        Schema::dropIfExists('departments');
        Schema::dropIfExists('jobs');
        Schema::dropIfExists('locations');
        Schema::dropIfExists('countries');
        Schema::dropIfExists('regions');
    }
};
