<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('catalog_teacher', function (Blueprint $table) {
            $table->foreignId('catalog_id')
                ->constrained('catalogs')
                ->onDelete('cascade');

            $table->foreignId('teacher_id')
                ->constrained('teachers')
                ->onDelete('cascade');

            $table->primary(['catalog_id', 'teacher_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('catalog_teacher');
    }
};
