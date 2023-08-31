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
            $table->string('account_id');
            $table->string('category_id');
            $table->string('course_id');
            $table->string('department_id');
            $table->string('mpesa_id');
            $table->string('role_id');
            $table->string('staff_id');
            $table->string('student_id');
            $table->string('transaction_id');
            $table->string('unit_id');
            $table->string('user_id');
            $table->timestamp('created_at');
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
