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
        Schema::create('tbl_attendances', function(Blueprint $table){
            $table->id();
            $table->foreignId('teaching_id')->constrained('tbl_teachings')->cascadeOnDelete();
            $table->foreignId('student_id')->constrained('tbl_users')->cascadeOnDelete();
            $table->date('date');
            $table->string('status');
            $table->unique(['student_id', 'date']);
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
