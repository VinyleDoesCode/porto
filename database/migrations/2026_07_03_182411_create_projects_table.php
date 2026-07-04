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
            $table->foreignId('profile_id')->constrained('profiles')->onDelete('cascade');
            $table->string('project_name');
            $table->text('description');
            $table->string('thumbnail')->nullable();
            $table->string('project_url')->nullable();
            $table->string('github_url')->nullable();
            $table->text('tech_stack')->nullable(); // Will hold JSON array of badges
            $table->string('category')->default('Graphic Design');
            $table->timestamps();
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
