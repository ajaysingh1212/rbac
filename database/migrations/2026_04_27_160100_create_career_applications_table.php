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
        Schema::create('career_applications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('advocated_content_id')
                ->constrained('advocated_contents')
                ->cascadeOnDelete();
            $table->string('full_name');
            $table->string('email');
            $table->string('phone', 50);
            $table->string('current_location')->nullable();
            $table->unsignedInteger('years_experience')->nullable();
            $table->string('linkedin_url')->nullable();
            $table->string('resume_path')->nullable();
            $table->longText('cover_letter')->nullable();
            $table->string('status', 50)->default('new');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('career_applications');
    }
};
