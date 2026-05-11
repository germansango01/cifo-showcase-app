<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up(): void
    {
        Schema::create('project_files', function (Blueprint $table) {
            $table->id();

            $table->foreignId('project_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->enum('type', [
                'pdf', 'document', 'spreadsheet', 'presentation',
                'markdown', 'video',
            ])->default('pdf');

            $table->string('url', 1024);
            $table->json('label')->nullable();
            $table->unsignedInteger('sort_order')->default(0);

            $table->index('project_id');
            $table->index('sort_order');

            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('project_files');
    }
};
