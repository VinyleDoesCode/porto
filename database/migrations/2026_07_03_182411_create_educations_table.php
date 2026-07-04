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
        Schema::create('educations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('profile_id')->constrained('profiles')->onDelete('cascade');
            $table->string('institution');
            $table->string('degree');
            $table->date('start_date');
            $table->date('end_date')->nullable(); // Null indicates "Present"
            $table->text('description')->nullable();
            
            // New columns for score stats and details
            $table->string('logo_text')->nullable();
            $table->string('logo_bg')->nullable();
            $table->string('gpa')->nullable();
            $table->string('eprt')->nullable();
            $table->string('tak')->nullable();
            $table->string('final_grade')->nullable();
            $table->string('nim')->nullable();
            $table->string('angkatan')->nullable();
            $table->string('dosen_wali')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('educations');
    }
};
