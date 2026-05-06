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
        Schema::create('tbl_tasks', function(Blueprint $table){
            $table->id();
            $table->string('title');
            $table->foreignId('teaching_id')->constrained('tbl_teachings')->cascadeOnDelete();
            $table->date('due_date')->nullable();
            $table->enum('type', ['assignment', 'oral']);
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
