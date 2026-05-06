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
        Schema::create('projects', function (Blueprint $table) {
            $table->id();

            $table->foreignId('course_id')
                ->constrained('courses')
                ->onDelete('cascade');

            $table->date('project_date');
            $table->json('slug');
            $table->json('title');
            $table->json('description')->nullable();
            $table->string('repo_url', 512)->nullable();
            $table->string('live_url', 512)->nullable();
            $table->enum('status', ['draft', 'pending', 'published', 'rejected'])
                ->default('draft');
            $table->boolean('featured')->default(false);
            $table->timestamp('published_at')->nullable();

            $table->index('status');
            $table->index('featured');
            $table->index('project_date');

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
