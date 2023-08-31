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
        Schema::create('notifications', function (Blueprint $table) {
            $table->id();
            $table->string('message');
            $table->string('account_id')->nullable();
            $table->string('category_id')->nullable();
            $table->string('course_id')->nullable();
            $table->string('department_id')->nullable();
            $table->string('mpesa_id')->nullable();
            $table->string('role_id')->nullable();
            $table->string('staff_id')->nullable();
            $table->string('student_id')->nullable();
            $table->string('transaction_id')->nullable();
            $table->string('unit_id')->nullable();
            $table->string('user_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notifications');
    }
};
