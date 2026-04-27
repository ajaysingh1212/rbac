<?php

namespace Database\Seeders;

use App\Models\AdvocatedContent;
use App\Models\User;
use Database\Seeders\Concerns\BuildsPlaceholderMedia;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ServiceContentSeeder extends Seeder
{
    use BuildsPlaceholderMedia;

    public function run(): void
    {
        $authorId = User::query()->value('id');
        $services = [
            ['Corporate Litigation', 'High-stakes boardroom disputes and regulatory challenges.'],
            ['Arbitration Advisory', 'Private dispute resolution with strong strategy and speed.'],
            ['Startup Legal Stack', 'Entity setup, contracts, IP, and investment readiness.'],
            ['Employment Counsel', 'Sensitive workplace disputes, policy design, and compliance.'],
            ['Intellectual Property', 'Brand, copyright, and idea protection for growing businesses.'],
            ['Real Estate Transactions', 'Deal structuring, title review, and risk negotiation.'],
            ['White Collar Defense', 'Investigations, notices, crisis response, and court protection.'],
            ['Family Wealth Planning', 'Succession, trusts, private family governance, and estates.'],
            ['Tax Dispute Resolution', 'Representations for assessments, appeals, and investigations.'],
            ['Digital Compliance', 'Data protection, platform terms, cyber-readiness, and privacy.'],
        ];

        foreach ($services as $index => [$title, $tagline]) {
            $slug = Str::slug($title);

            AdvocatedContent::updateOrCreate(
                ['section' => 'services', 'slug' => $slug],
                [
                    'title' => $title,
                    'tagline' => $tagline,
                    'subheading' => 'Strategic legal representation built for modern businesses and discerning individuals.',
                    'excerpt' => $tagline,
                    'summary' => 'Advocated delivers outcome-driven legal support with senior oversight, clear communication, and practical execution.',
                    'description' => 'This service is designed for clients who need both legal depth and decisive movement. We combine advisory precision, courtroom fluency, and commercial awareness so that each matter stays aligned with the client goal.',
                    'detailed_content' => 'From early risk mapping to final resolution, Advocated structures each engagement around preparation, speed, and reputation protection. Our teams work across drafting, strategy, hearings, negotiation, and stakeholder coordination.',
                    'quote' => 'Great advocacy is not only persuasive in court, it is calming in moments of business pressure.',
                    'author_name' => 'Advocated Strategy Desk',
                    'author_designation' => 'Legal Advisory Team',
                    'practice_area' => $title,
                    'consultation_fee' => 2500 + ($index * 500),
                    'currency' => 'INR',
                    'cta_text' => 'Book a Consultation',
                    'cta_link' => url('/contact'),
                    'secondary_cta_text' => 'Explore Team',
                    'secondary_cta_link' => url('/team'),
                    'featured_image' => $this->placeholderImage('seed/services', $slug, $title, 'Premium Legal Service', '#d07a47'),
                    'banner_image' => $this->placeholderImage('seed/services', $slug.'-banner', $title, 'Advisory. Litigation. Protection.', '#ad5b2f'),
                    'thumbnail_image' => $this->placeholderImage('seed/services', $slug.'-thumb', $title, 'Advocated Service', '#f2c28e'),
                    'badge_text' => 'Client Favorite',
                    'badge_color' => '#d07a47',
                    'status' => 'published',
                    'is_featured' => $index < 4,
                    'show_on_homepage' => $index < 6,
                    'show_in_menu' => true,
                    'sort_order' => $index + 1,
                    'reading_time' => 5,
                    'published_at' => now()->subDays($index + 1),
                    'highlights' => ['Strategic case mapping', 'Partner-led review', 'Fast turnaround'],
                    'key_points' => ['Commercially practical advice', 'Courtroom-ready drafting', 'Transparent communication'],
                    'requirements' => ['Case documents', 'Commercial context', 'Desired outcome clarity'],
                    'responsibilities' => ['Legal analysis', 'Drafting and filings', 'Negotiation and representation'],
                    'benefits' => ['Reduced uncertainty', 'Stronger positioning', 'Clear legal roadmap'],
                    'seo_keywords' => ['advocate service', strtolower($title), 'legal advisory india'],
                    'faqs' => [
                        ['question' => 'Who is this service best for?', 'answer' => 'Founders, business leaders, families, and institutions that need rigorous legal support.'],
                        ['question' => 'How quickly can Advocated begin?', 'answer' => 'Urgent matters can be triaged rapidly once core documents and instructions are received.'],
                    ],
                    'social_links' => ['linkedin' => 'https://www.linkedin.com/company/advocated'],
                    'schema_type' => 'LegalService',
                    'meta_title' => $title.' | Advocated',
                    'meta_description' => 'Explore '.$title.' at Advocated with strategic, business-aware legal support.',
                    'canonical_url' => url('/services/'.$slug),
                    'og_title' => $title.' | Advocated',
                    'og_description' => $tagline,
                    'og_image' => 'seed/services/'.$slug.'-banner.svg',
                    'created_by' => $authorId,
                    'updated_by' => $authorId,
                ]
            );
        }
    }
}
