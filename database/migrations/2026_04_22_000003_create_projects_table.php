<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up(): void
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained()->cascadeOnDelete();
            $table->foreignId('professor_id')->nullable()->constrained()->nullOnDelete();
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('short_description');
            $table->text('description');
            $table->string('cycle', 10);          // DAW | DAM | ASIR | SMX
            $table->unsignedSmallInteger('year');
            $table->string('thumbnail_url');
            $table->string('demo_url')->nullable();
            $table->string('repo_url')->nullable();
            $table->boolean('featured')->default(false);
            $table->timestamps();

            $table->index(['cycle', 'year']);
            $table->index('featured');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
