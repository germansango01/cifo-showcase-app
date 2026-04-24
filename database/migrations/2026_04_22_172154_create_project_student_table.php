<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('project_student', function (Blueprint $table) {

            $table->foreignId('project_id')
                ->constrained('projects')
                ->onDelete('cascade');

            $table->foreignId('student_id')
                ->constrained('students')
                ->onDelete('cascade');

            $table->primary(['project_id', 'student_id']);

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('project_student');
    }
};
