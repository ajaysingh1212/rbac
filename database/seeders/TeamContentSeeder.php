<?php

namespace Database\Seeders;

use App\Models\AdvocatedContent;
use App\Models\User;
use Database\Seeders\Concerns\BuildsPlaceholderMedia;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class TeamContentSeeder extends Seeder
{
    use BuildsPlaceholderMedia;

    public function run(): void
    {
        $authorId = User::query()->value('id');
        $members = [
            ['Aarav Mehta', 'Managing Partner', 'Dispute Resolution'],
            ['Naina Kapoor', 'Partner', 'Corporate Advisory'],
            ['Kabir Sethi', 'Senior Counsel', 'Arbitration'],
            ['Ira Bansal', 'Principal Associate', 'Employment Law'],
            ['Vivaan Arora', 'Partner', 'White Collar Defense'],
            ['Anaya Dutt', 'Head of Research', 'Policy and Compliance'],
            ['Reyansh Malhotra', 'Senior Associate', 'IP and Technology'],
            ['Meher Suri', 'Client Strategy Lead', 'Private Clients'],
            ['Ishaan Khanna', 'Associate', 'Real Estate'],
            ['Siya Narang', 'Legal Operations Lead', 'Execution Excellence'],
        ];

        foreach ($members as $index => [$name, $role, $practice]) {
            $slug = Str::slug($name);

            AdvocatedContent::updateOrCreate(
                ['section' => 'team', 'slug' => $slug],
                [
                    'title' => $name,
                    'tagline' => $role,
                    'subheading' => 'A trusted Advocated professional focused on calm, strategic, high-standard execution.',
                    'excerpt' => $name.' leads with precision, empathy, and disciplined legal judgment.',
                    'summary' => $name.' works across high-stakes matters with strong client communication and commercial awareness.',
                    'description' => 'Our team profiles are designed to help clients understand not only credentials, but also style, focus area, and leadership approach.',
                    'detailed_content' => $name.' supports clients with a blend of technical rigor, collaborative execution, and outcome-focused planning across the '.$practice.' practice.',
                    'author_name' => $name,
                    'author_designation' => $role,
                    'team_role' => $role,
                    'practice_area' => $practice,
                    'experience_years' => 4 + $index,
                    'education' => 'LL.B, National Law University',
                    'contact_email' => Str::slug($name). '@advocatedlegal.in',
                    'contact_phone' => '+91 98989'.str_pad((string) $index, 4, '0', STR_PAD_LEFT),
                    'cta_text' => 'Speak With Our Team',
                    'cta_link' => url('/contact'),
                    'secondary_cta_text' => 'View Services',
                    'secondary_cta_link' => url('/services'),
                    'featured_image' => $this->placeholderImage('seed/team', $slug, $name, $role, '#ba7a4d'),
                    'banner_image' => $this->placeholderImage('seed/team', $slug.'-banner', $name, $practice, '#88573d'),
                    'thumbnail_image' => $this->placeholderImage('seed/team', $slug.'-thumb', 'Advocated', $name, '#f1d2b6'),
                    'badge_text' => $practice,
                    'badge_color' => '#ba7a4d',
                    'status' => 'published',
                    'is_featured' => $index < 4,
                    'show_on_homepage' => $index < 4,
                    'sort_order' => $index + 1,
                    'published_at' => now()->subDays($index + 4),
                    'highlights' => ['Client-centric communication', 'Strategic preparation', 'Cross-functional collaboration'],
                    'key_points' => ['Trusted advisor', 'Strong drafting discipline', 'High ownership mindset'],
                    'social_links' => ['linkedin' => 'https://www.linkedin.com/company/advocated'],
                    'schema_type' => 'Person',
                    'meta_title' => $name.' | '.$role.' | Advocated',
                    'meta_description' => 'Meet '.$name.', '.$role.' at Advocated.',
                    'canonical_url' => url('/team/'.$slug),
                    'og_title' => $name.' | Advocated',
                    'og_description' => $role.' focused on '.$practice.'.',
                    'og_image' => 'seed/team/'.$slug.'-banner.svg',
                    'created_by' => $authorId,
                    'updated_by' => $authorId,
                ]
            );
        }
    }
}
