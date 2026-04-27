<?php

namespace Database\Seeders;

use App\Models\AdvocatedContent;
use App\Models\User;
use Database\Seeders\Concerns\BuildsPlaceholderMedia;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProBonoContentSeeder extends Seeder
{
    use BuildsPlaceholderMedia;

    public function run(): void
    {
        $authorId = User::query()->value('id');
        $stories = [
            'Legal literacy clinics for first-generation women entrepreneurs',
            'Emergency representation support for domestic violence survivors',
            'Documentation rights camp for migrant worker families',
            'School-based awareness drive on cyber safety and reporting',
            'Mentorship track for public interest law students',
            'Community workshop on inheritance rights and access',
            'Pro bono advisory for disability inclusion policies',
            'Support desk for housing documentation disputes',
            'Rural outreach on identity, welfare, and grievance escalation',
            'Strategic nonprofit counsel for impact-led collectives',
        ];

        foreach ($stories as $index => $title) {
            $slug = Str::slug($title);

            AdvocatedContent::updateOrCreate(
                ['section' => 'pro-bono', 'slug' => $slug],
                [
                    'title' => Str::title($title),
                    'tagline' => 'Advocacy with social purpose, dignity, and measurable community value.',
                    'subheading' => 'Impact work that reflects the human side of legal practice.',
                    'excerpt' => 'A pro bono initiative focused on access, fairness, and practical empowerment.',
                    'summary' => 'Advocated believes professional excellence and community commitment should live side by side.',
                    'description' => 'These stories showcase how legal strategy can support vulnerable communities, mission-led institutions, and people navigating systems without equal access.',
                    'detailed_content' => 'Each initiative is designed for practical usefulness: rights education, document support, referral systems, emergency advisory, or longer-term policy assistance.',
                    'author_name' => 'Pro Bono Collective',
                    'author_designation' => 'Community Impact Desk',
                    'practice_area' => 'Pro Bono and Social Justice',
                    'cta_text' => 'Partner With Us',
                    'cta_link' => url('/contact'),
                    'secondary_cta_text' => 'Meet the Team',
                    'secondary_cta_link' => url('/team'),
                    'featured_image' => $this->placeholderImage('seed/pro-bono', $slug, 'Impact Story', Str::title($title), '#b86a58'),
                    'banner_image' => $this->placeholderImage('seed/pro-bono', $slug.'-banner', 'Pro Bono', 'Community-centered advocacy', '#8f4336'),
                    'thumbnail_image' => $this->placeholderImage('seed/pro-bono', $slug.'-thumb', 'Advocated', 'Impact work', '#f1cec8'),
                    'badge_text' => 'Community Impact',
                    'badge_color' => '#b86a58',
                    'status' => 'published',
                    'is_featured' => $index < 4,
                    'show_on_homepage' => $index < 3,
                    'sort_order' => $index + 1,
                    'published_at' => now()->subDays($index + 8),
                    'highlights' => ['Rights awareness', 'Ground support', 'Sustained community trust'],
                    'key_points' => ['Access to justice', 'Human-centered design', 'Long-term partnerships'],
                    'seo_keywords' => ['pro bono legal services', 'advocated impact', Str::slug($title, ' ')],
                    'faqs' => [
                        ['question' => 'Can organizations collaborate?', 'answer' => 'Yes, Advocated welcomes aligned nonprofit, institutional, and community partnerships.'],
                        ['question' => 'How are initiatives selected?', 'answer' => 'We prioritize urgency, sustained need, and the ability to create meaningful impact.'],
                    ],
                    'schema_type' => 'Article',
                    'meta_title' => Str::title($title).' | Advocated Pro Bono',
                    'meta_description' => 'See how Advocated contributes through pro bono legal initiatives.',
                    'canonical_url' => url('/probono/'.$slug),
                    'og_title' => Str::title($title).' | Advocated',
                    'og_description' => 'Purpose-led legal impact by Advocated.',
                    'og_image' => 'seed/pro-bono/'.$slug.'-banner.svg',
                    'created_by' => $authorId,
                    'updated_by' => $authorId,
                ]
            );
        }
    }
}
