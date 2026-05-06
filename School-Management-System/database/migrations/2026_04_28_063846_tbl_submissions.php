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
        Schema::create('tbl_submissions', function(Blueprint $table){
            $table->id();
            $table->foreignId('task_id')->constrained('tbl_tasks')->cascadeOnDelete();
            $table->foreignId('student_id')->constrained('tbl_users')->cascadeOnDelete();
            $table->text('content')->nullable();
            $table->timestamp('submitted_at')->nullable();
            $table->unique(['task_id', 'student_id']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
