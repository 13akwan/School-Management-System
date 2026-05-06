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
        Schema::create('tbl_teachings', function(Blueprint $table){
            $table->id();
            $table->foreignId('subject_id')->constrained('tbl_subjects')->cascadeOnDelete();
            $table->foreignId('teacher_id')->constrained('tbl_users')->cascadeOnDelete();
            $table->foreignId('class_id')->constrained('tbl_classes')->cascadeOnDelete();
            $table->unique(['teacher_id', 'subject_id', 'class_id']);
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
