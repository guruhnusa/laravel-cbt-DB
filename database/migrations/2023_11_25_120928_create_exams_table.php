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
        Schema::create('exams', function (Blueprint $table) {
            $table->id();
            //user id
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            //score numeric,verbal,logika,
            $table->integer('score_numeric')->nullable();
            $table->integer('score_verbal')->nullable();
            $table->integer('score_logika')->nullable();
            //status ujian enum('start','done')
            $table->enum('status_numeric', ['start', 'done'])->default('start');
            $table->enum('status_verbal', ['start', 'done'])->default('start');
            $table->enum('status_logika', ['start', 'done'])->default('start');
            //timer exam
            $table->integer('timer_numeric')->nullable();
            $table->integer('timer_logika')->nullable();
            $table->integer('timer_verbal')->nullable();
            //results
            $table->string('result')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('exams');
    }
};
