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
        Schema::create('advocated_contents', function (Blueprint $table) {
            $table->id();
            $table->string('section', 80)->index();
            $table->string('title', 191);
            $table->string('slug', 191);
            $table->string('tagline', 191)->nullable();
            $table->string('subheading', 191)->nullable();
            $table->text('excerpt')->nullable();
            $table->text('summary')->nullable();
            $table->longText('description')->nullable();
            $table->longText('detailed_content')->nullable();
            $table->longText('quote')->nullable();
            $table->string('author_name', 150)->nullable();
            $table->string('author_designation', 150)->nullable();
            $table->string('team_role', 150)->nullable();
            $table->string('practice_area', 150)->nullable();
            $table->unsignedInteger('experience_years')->nullable();
            $table->string('license_number', 150)->nullable();
            $table->string('education', 191)->nullable();
            $table->string('job_location', 150)->nullable();
            $table->string('job_type', 120)->nullable();
            $table->string('salary_range', 120)->nullable();
            $table->date('application_deadline')->nullable();
            $table->string('contact_person', 150)->nullable();
            $table->string('contact_email', 191)->nullable();
            $table->string('contact_phone', 50)->nullable();
            $table->string('whatsapp_number', 50)->nullable();
            $table->string('office_location', 150)->nullable();
            $table->string('office_address', 191)->nullable();
            $table->string('opening_hours', 150)->nullable();
            $table->text('map_embed_url')->nullable();
            $table->text('video_url')->nullable();
            $table->string('video_duration', 50)->nullable();
            $table->string('cta_text', 150)->nullable();
            $table->text('cta_link')->nullable();
            $table->string('secondary_cta_text', 150)->nullable();
            $table->text('secondary_cta_link')->nullable();
            $table->string('featured_image')->nullable();
            $table->string('banner_image')->nullable();
            $table->string('thumbnail_image')->nullable();
            $table->string('brochure_file')->nullable();
            $table->string('badge_text', 150)->nullable();
            $table->string('badge_color', 50)->nullable();
            $table->decimal('consultation_fee', 12, 2)->nullable();
            $table->string('currency', 10)->nullable();
            $table->string('status', 50)->default('draft')->index();
            $table->boolean('is_featured')->default(false);
            $table->boolean('show_on_homepage')->default(false);
            $table->boolean('show_in_menu')->default(false);
            $table->unsignedInteger('sort_order')->default(0);
            $table->unsignedInteger('reading_time')->nullable();
            $table->timestamp('published_at')->nullable();
            $table->json('highlights')->nullable();
            $table->json('key_points')->nullable();
            $table->json('requirements')->nullable();
            $table->json('responsibilities')->nullable();
            $table->json('benefits')->nullable();
            $table->json('seo_keywords')->nullable();
            $table->json('gallery_images')->nullable();
            $table->json('faqs')->nullable();
            $table->json('social_links')->nullable();
            $table->json('extra_attributes')->nullable();
            $table->string('schema_type', 120)->nullable();
            $table->string('meta_title', 191)->nullable();
            $table->text('meta_description')->nullable();
            $table->text('canonical_url')->nullable();
            $table->string('og_title', 191)->nullable();
            $table->text('og_description')->nullable();
            $table->text('og_image')->nullable();
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('updated_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();

            $table->unique(['section', 'slug']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('advocated_contents');
    }
};
