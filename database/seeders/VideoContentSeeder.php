<?php

namespace Database\Seeders;

use App\Models\AdvocatedContent;
use App\Models\User;
use Database\Seeders\Concerns\BuildsPlaceholderMedia;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class VideoContentSeeder extends Seeder
{
    use BuildsPlaceholderMedia;

    public function run(): void
    {
        $authorId = User::query()->value('id');
        $videos = [
            'What to do in the first 24 hours of a legal dispute',
            'Founder contracts that deserve immediate review',
            'How Advocated prepares clients for arbitration hearings',
            'Employment investigations without reputational damage',
            'A quick explainer on trademark risk for new brands',
            'What senior counsel notices in weak legal documentation',
            'How to respond to a legal notice with discipline',
            'Data privacy basics for leadership teams',
            'The anatomy of a strong client briefing',
            'What quality legal ops looks like behind the scenes',
        ];

        foreach ($videos as $index => $title) {
            $slug = Str::slug($title);

            AdvocatedContent::updateOrCreate(
                ['section' => 'videos', 'slug' => $slug],
                [
                    'title' => Str::title($title),
                    'tagline' => 'Short-form legal explainers made for fast, useful understanding.',
                    'subheading' => 'Video insights that translate complex legal ideas into crisp guidance.',
                    'excerpt' => 'An Advocated video designed to make legal issues feel more navigable.',
                    'summary' => 'These videos support clients and teams who prefer sharp, visual explanations and practical context.',
                    'description' => 'Advocated videos bring together advisory clarity, calm delivery, and topic-specific legal insight for busy viewers.',
                    'detailed_content' => 'Each recording is structured around a question clients often ask. We focus on timing, documentation, red flags, and action paths rather than abstract commentary.',
                    'author_name' => 'Advocated Media Desk',
                    'author_designation' => 'Video Series Host',
                    'practice_area' => 'Video Knowledge Series',
                    'video_url' => 'https://www.youtube.com/embed/dQw4w9WgXcQ?autoplay=0&rel=0&index=' . ($index + 1),
                    'video_duration' => '0'.($index % 5 + 4).':2'.($index % 6),
                    'cta_text' => 'Book Advisory Session',
                    'cta_link' => url('/contact'),
                    'secondary_cta_text' => 'Read More Insights',
                    'secondary_cta_link' => url('/blog'),
                    'featured_image' => $this->placeholderImage('seed/videos', $slug, 'Video Briefing', Str::title($title), '#c98b52'),
                    'banner_image' => $this->placeholderImage('seed/videos', $slug.'-banner', 'Advocated Video', 'Knowledge in motion', '#8d5c39'),
                    'thumbnail_image' => $this->placeholderImage('seed/videos', $slug.'-thumb', 'Play', Str::title($title), '#f3d2ab'),
                    'badge_text' => 'Video Brief',
                    'badge_color' => '#c98b52',
                    'status' => 'published',
                    'is_featured' => $index < 4,
                    'show_on_homepage' => $index < 3,
                    'sort_order' => $index + 1,
                    'published_at' => now()->subDays($index + 2),
                    'highlights' => ['Fast to watch', 'Action-led structure', 'Practical legal framing'],
                    'key_points' => ['Real client scenarios', 'Risk signals', 'Suggested next steps'],
                    'seo_keywords' => ['legal video', 'advocated video', Str::slug($title, ' ')],
                    'faqs' => [
                        ['question' => 'Who are these videos for?', 'answer' => 'Founders, operators, legal teams, and clients who want concise legal education.'],
                        ['question' => 'Can I discuss my case after watching?', 'answer' => 'Yes, you can contact the Advocated team for a tailored consultation.'],
                    ],
                    'schema_type' => 'VideoObject',
                    'meta_title' => Str::title($title).' | Advocated Videos',
                    'meta_description' => 'Watch Advocated explain '.strtolower($title).'.',
                    'canonical_url' => url('/video/'.$slug),
                    'og_title' => Str::title($title).' | Advocated',
                    'og_description' => 'Practical legal insight in a short video format.',
                    'og_image' => 'seed/videos/'.$slug.'-banner.svg',
                    'created_by' => $authorId,
                    'updated_by' => $authorId,
                ]
            );
        }
    }
}
