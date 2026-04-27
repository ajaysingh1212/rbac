<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Arr;

class AdvocatedContent extends Model
{
    use HasFactory;

    protected $fillable = [
        'section',
        'title',
        'slug',
        'tagline',
        'subheading',
        'excerpt',
        'summary',
        'description',
        'detailed_content',
        'quote',
        'author_name',
        'author_designation',
        'team_role',
        'practice_area',
        'experience_years',
        'license_number',
        'education',
        'job_location',
        'job_type',
        'salary_range',
        'application_deadline',
        'contact_person',
        'contact_email',
        'contact_phone',
        'whatsapp_number',
        'office_location',
        'office_address',
        'opening_hours',
        'map_embed_url',
        'video_url',
        'video_duration',
        'cta_text',
        'cta_link',
        'secondary_cta_text',
        'secondary_cta_link',
        'featured_image',
        'banner_image',
        'thumbnail_image',
        'brochure_file',
        'badge_text',
        'badge_color',
        'consultation_fee',
        'currency',
        'status',
        'is_featured',
        'show_on_homepage',
        'show_in_menu',
        'sort_order',
        'reading_time',
        'published_at',
        'highlights',
        'key_points',
        'requirements',
        'responsibilities',
        'benefits',
        'seo_keywords',
        'gallery_images',
        'faqs',
        'social_links',
        'extra_attributes',
        'schema_type',
        'meta_title',
        'meta_description',
        'canonical_url',
        'og_title',
        'og_description',
        'og_image',
        'created_by',
        'updated_by',
    ];

    protected function casts(): array
    {
        return [
            'application_deadline' => 'date',
            'published_at' => 'datetime',
            'consultation_fee' => 'decimal:2',
            'experience_years' => 'integer',
            'reading_time' => 'integer',
            'sort_order' => 'integer',
            'is_featured' => 'boolean',
            'show_on_homepage' => 'boolean',
            'show_in_menu' => 'boolean',
            'highlights' => 'array',
            'key_points' => 'array',
            'requirements' => 'array',
            'responsibilities' => 'array',
            'benefits' => 'array',
            'seo_keywords' => 'array',
            'gallery_images' => 'array',
            'faqs' => 'array',
            'social_links' => 'array',
            'extra_attributes' => 'array',
        ];
    }

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function updater(): BelongsTo
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    public function scopeForSection($query, string $section)
    {
        return $query->where('section', $section);
    }

    public static function sections(): array
    {
        return config('advocated_content.sections', []);
    }

    public static function sectionKeys(): array
    {
        return array_keys(static::sections());
    }

    public static function sectionMeta(string $section): array
    {
        $meta = Arr::get(static::sections(), $section, []);

        return $meta ? array_merge($meta, ['key' => $section]) : [];
    }

    public static function statuses(): array
    {
        return config('advocated_content.statuses', []);
    }

    public function getSectionDetailsAttribute(): array
    {
        return static::sectionMeta($this->section);
    }

    public function getStatusLabelAttribute(): string
    {
        return static::statuses()[$this->status] ?? ucfirst($this->status);
    }
}
