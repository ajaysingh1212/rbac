<?php

namespace Database\Seeders;

use App\Models\AdvocatedContent;
use App\Models\User;
use Database\Seeders\Concerns\BuildsPlaceholderMedia;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CareerContentSeeder extends Seeder
{
    use BuildsPlaceholderMedia;

    public function run(): void
    {
        $authorId = User::query()->value('id');
        $roles = [
            'Senior Associate - Corporate Litigation',
            'Associate - Dispute Resolution',
            'Legal Research Analyst',
            'Principal Associate - Employment Advisory',
            'Associate - White Collar and Investigations',
            'Manager - Client Success and Legal Operations',
            'Intern - Policy and Public Interest',
            'Senior Associate - IP and Technology',
            'Associate - Real Estate Transactions',
            'Knowledge and Content Counsel',
        ];

        foreach ($roles as $index => $title) {
            $slug = Str::slug($title);

            AdvocatedContent::updateOrCreate(
                ['section' => 'careers', 'slug' => $slug],
                [
                    'title' => $title,
                    'tagline' => 'Build an ambitious legal career with structured mentorship and real responsibility.',
                    'subheading' => 'Advocated is hiring thoughtful professionals who care about craft, clients, and consistency.',
                    'excerpt' => 'Join a firm environment that values calm execution, preparation, and client trust.',
                    'summary' => 'Every role at Advocated is built around ownership, quality, communication, and long-term professional growth.',
                    'description' => 'This career opening is for professionals who want meaningful legal work, high standards, and a collaborative team environment.',
                    'detailed_content' => 'Candidates should be rigorous, commercially aware, and able to communicate with clarity under pressure. Advocated invests in people who combine technical discipline with service mindset.',
                    'practice_area' => 'Careers',
                    'job_location' => $index % 2 === 0 ? 'New Delhi' : 'Gurugram',
                    'job_type' => $index % 3 === 0 ? 'Full-time' : 'Hybrid',
                    'salary_range' => 'INR '.(8 + $index).' LPA - INR '.(12 + $index).' LPA',
                    'application_deadline' => now()->addDays(25 + $index)->toDateString(),
                    'contact_person' => 'Talent Acquisition Desk',
                    'contact_email' => 'careers@advocatedlegal.in',
                    'contact_phone' => '+91 98100123'.str_pad((string) $index, 2, '0', STR_PAD_LEFT),
                    'office_location' => 'Advocated Career Hub',
                    'office_address' => 'Sector 44, NCR Legal District',
                    'cta_text' => 'Apply for this Role',
                    'cta_link' => url('/careers/'.$slug),
                    'secondary_cta_text' => 'See All Careers',
                    'secondary_cta_link' => url('/careers'),
                    'featured_image' => $this->placeholderImage('seed/careers', $slug, 'Join Advocated', $title, '#c97340'),
                    'banner_image' => $this->placeholderImage('seed/careers', $slug.'-banner', $title, 'Careers at Advocated', '#9e552d'),
                    'thumbnail_image' => $this->placeholderImage('seed/careers', $slug.'-thumb', 'Career', $title, '#f0c79f'),
                    'badge_text' => $index < 3 ? 'Urgent Hiring' : 'Now Open',
                    'badge_color' => '#c97340',
                    'status' => 'published',
                    'is_featured' => $index < 4,
                    'show_on_homepage' => $index < 4,
                    'sort_order' => $index + 1,
                    'published_at' => now()->subDays($index + 3),
                    'highlights' => ['Mentored growth path', 'High-caliber matters', 'Direct exposure to strategy'],
                    'requirements' => ['Strong drafting ability', 'Professional communication', 'Ownership mindset'],
                    'responsibilities' => ['Matter preparation', 'Client coordination', 'Research and drafting'],
                    'benefits' => ['Structured review cycles', 'Mentorship access', 'Visible growth opportunities'],
                    'seo_keywords' => ['legal jobs', 'law firm careers', Str::slug($title, ' ')],
                    'faqs' => [
                        ['question' => 'Can experienced candidates apply?', 'answer' => 'Yes, Advocated welcomes both emerging and experienced professionals based on role fit.'],
                        ['question' => 'Is hybrid work available?', 'answer' => 'Several roles support hybrid flexibility depending on practice needs.'],
                    ],
                    'schema_type' => 'JobPosting',
                    'meta_title' => $title.' | Careers at Advocated',
                    'meta_description' => 'Apply for '.$title.' at Advocated.',
                    'canonical_url' => url('/careers/'.$slug),
                    'og_title' => $title.' | Advocated Careers',
                    'og_description' => 'Grow your legal career with Advocated.',
                    'og_image' => 'seed/careers/'.$slug.'-banner.svg',
                    'created_by' => $authorId,
                    'updated_by' => $authorId,
                ]
            );
        }
    }
}
