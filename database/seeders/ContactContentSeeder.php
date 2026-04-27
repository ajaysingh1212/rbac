<?php

namespace Database\Seeders;

use App\Models\AdvocatedContent;
use App\Models\User;
use Database\Seeders\Concerns\BuildsPlaceholderMedia;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ContactContentSeeder extends Seeder
{
    use BuildsPlaceholderMedia;

    public function run(): void
    {
        $authorId = User::query()->value('id');
        $offices = [
            ['New Delhi Chambers', 'Supreme Court district, New Delhi', '+91 98100 00001'],
            ['Gurugram Advisory Hub', 'Cyber City legal corridor, Gurugram', '+91 98100 00002'],
            ['Mumbai Client Desk', 'BKC business district, Mumbai', '+91 98100 00003'],
        ];

        foreach ($offices as $index => [$title, $address, $phone]) {
            $slug = Str::slug($title);

            AdvocatedContent::updateOrCreate(
                ['section' => 'contact-us', 'slug' => $slug],
                [
                    'title' => $title,
                    'tagline' => 'A polished, responsive contact experience for clients who need clarity fast.',
                    'subheading' => 'Reach Advocated through the location that best matches your need or geography.',
                    'excerpt' => 'Each contact block is structured to help clients connect with confidence.',
                    'summary' => 'Our offices are designed around responsiveness, privacy, and strong first-touch client service.',
                    'description' => 'From first consultations to ongoing matter coordination, Advocated maintains client touchpoints that feel clear, premium, and dependable.',
                    'detailed_content' => 'Visitors can reach the relevant team through phone, email, or office coordination. The contact page is designed to support urgent matters, structured consultations, and location-specific visits.',
                    'contact_person' => 'Client Relations Team',
                    'contact_email' => 'contact@advocatedlegal.in',
                    'contact_phone' => $phone,
                    'whatsapp_number' => $phone,
                    'office_location' => $title,
                    'office_address' => $address,
                    'opening_hours' => 'Monday to Saturday, 10:00 AM to 7:00 PM',
                    'map_embed_url' => 'https://maps.google.com/?q='.urlencode($address),
                    'cta_text' => 'Request a Call Back',
                    'cta_link' => 'mailto:contact@advocatedlegal.in',
                    'secondary_cta_text' => 'View Services',
                    'secondary_cta_link' => url('/services'),
                    'featured_image' => $this->placeholderImage('seed/contact', $slug, $title, 'Advocated Contact Desk', '#aa6d55'),
                    'banner_image' => $this->placeholderImage('seed/contact', $slug.'-banner', 'Contact Advocated', $title, '#7c4332'),
                    'thumbnail_image' => $this->placeholderImage('seed/contact', $slug.'-thumb', 'Contact', $title, '#f0d2c8'),
                    'badge_text' => 'Open for Consultation',
                    'badge_color' => '#aa6d55',
                    'status' => 'published',
                    'is_featured' => $index === 0,
                    'show_on_homepage' => true,
                    'show_in_menu' => true,
                    'sort_order' => $index + 1,
                    'published_at' => now()->subDays($index + 1),
                    'highlights' => ['Fast response desk', 'Confidential intake', 'Location-aware support'],
                    'key_points' => ['Visit-ready offices', 'Phone and WhatsApp access', 'Clear office timing'],
                    'seo_keywords' => ['contact advocated', strtolower($title), 'law firm contact'],
                    'faqs' => [
                        ['question' => 'Can I request an urgent callback?', 'answer' => 'Yes, urgent matters can be flagged through the contact channels listed on this page.'],
                        ['question' => 'Do you support virtual consultations?', 'answer' => 'Yes, Advocated offers remote consultations where appropriate.'],
                    ],
                    'schema_type' => 'ContactPage',
                    'meta_title' => $title.' | Contact Advocated',
                    'meta_description' => 'Reach Advocated through '.$title.'.',
                    'canonical_url' => url('/contact'),
                    'og_title' => $title.' | Advocated',
                    'og_description' => 'Premium legal support begins with responsive client communication.',
                    'og_image' => 'seed/contact/'.$slug.'-banner.svg',
                    'created_by' => $authorId,
                    'updated_by' => $authorId,
                ]
            );
        }
    }
}
