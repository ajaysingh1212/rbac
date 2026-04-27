<?php

namespace Database\Seeders;

use App\Models\AdvocatedContent;
use App\Models\User;
use Database\Seeders\Concerns\BuildsPlaceholderMedia;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class BlogContentSeeder extends Seeder
{
    use BuildsPlaceholderMedia;

    public function run(): void
    {
        $authorId = User::query()->value('id');
        $blogs = [
            'How founders should negotiate investor protection clauses',
            'A practical guide to handling employee misconduct investigations',
            'What businesses should know before sending a legal notice',
            'Five due-diligence mistakes that slow real estate closings',
            'Understanding enforceability in modern service contracts',
            'When arbitration is smarter than commercial litigation',
            'How to prepare for regulatory scrutiny without panic',
            'Trademark hygiene for fast-growing consumer brands',
            'The legal anatomy of a high-trust family settlement',
            'What a litigation-ready data retention policy looks like',
        ];

        foreach ($blogs as $index => $title) {
            $slug = Str::slug($title);

            AdvocatedContent::updateOrCreate(
                ['section' => 'blogs', 'slug' => $slug],
                [
                    'title' => Str::title($title),
                    'tagline' => 'Smart legal thinking translated into client-ready clarity.',
                    'subheading' => 'Insight from the Advocated editorial and advisory team.',
                    'excerpt' => 'A concise breakdown of a recurring legal decision point for modern clients.',
                    'summary' => 'This article distills a complex legal issue into practical guidance that leaders can actually act on.',
                    'description' => 'Advocated publishes insight pieces that help founders, general counsels, and families understand the commercial impact of legal choices before risk escalates.',
                    'detailed_content' => 'Each article is written in a pragmatic voice and organized around decisions, not jargon. The goal is to help readers move from confusion to confident action with clarity about next steps, timing, and documentation.',
                    'quote' => 'The strongest legal strategy often begins with the clearest explanation.',
                    'author_name' => 'Editorial Counsel '.($index + 1),
                    'author_designation' => 'Knowledge Partner',
                    'practice_area' => 'Thought Leadership',
                    'reading_time' => 6 + ($index % 3),
                    'cta_text' => 'Talk to a Lawyer',
                    'cta_link' => url('/contact'),
                    'secondary_cta_text' => 'Browse Services',
                    'secondary_cta_link' => url('/services'),
                    'featured_image' => $this->placeholderImage('seed/blogs', $slug, 'Legal Insight', Str::title($title), '#c08457'),
                    'banner_image' => $this->placeholderImage('seed/blogs', $slug.'-banner', 'Advocated Journal', Str::title($title), '#9a5c38'),
                    'thumbnail_image' => $this->placeholderImage('seed/blogs', $slug.'-thumb', 'Insight', 'Practical legal thinking', '#f0cfb2'),
                    'badge_text' => $index < 3 ? 'Trending Read' : 'Fresh Perspective',
                    'badge_color' => '#c08457',
                    'status' => 'published',
                    'is_featured' => $index < 3,
                    'show_on_homepage' => $index < 3,
                    'sort_order' => $index + 1,
                    'published_at' => now()->subDays($index + 2),
                    'highlights' => ['Readable explanations', 'Decision-oriented structure', 'Client-ready action points'],
                    'key_points' => ['Risk mapping', 'Commercial implications', 'Recommended next steps'],
                    'seo_keywords' => ['legal blog', 'advocated blog', Str::slug($title, ' ')],
                    'faqs' => [
                        ['question' => 'Who should read this?', 'answer' => 'Business leaders, in-house teams, and clients looking for practical legal guidance.'],
                        ['question' => 'Does this replace formal advice?', 'answer' => 'No. It helps frame issues, but specific advice should be tailored to your facts.'],
                    ],
                    'schema_type' => 'Article',
                    'meta_title' => Str::title($title).' | Advocated Blog',
                    'meta_description' => 'Read Advocated on '.strtolower($title).'.',
                    'canonical_url' => url('/blog/'.$slug),
                    'og_title' => Str::title($title).' | Advocated',
                    'og_description' => 'Practical legal insight for sharper decisions.',
                    'og_image' => 'seed/blogs/'.$slug.'-banner.svg',
                    'created_by' => $authorId,
                    'updated_by' => $authorId,
                ]
            );
        }
    }
}
