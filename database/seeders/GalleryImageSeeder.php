<?php

namespace Database\Seeders;

use App\Models\GalleryImage;
use Database\Seeders\Concerns\BuildsPlaceholderMedia;
use Illuminate\Database\Seeder;

class GalleryImageSeeder extends Seeder
{
    use BuildsPlaceholderMedia;

    public function run(): void
    {
        $themes = [
            'Courtroom Briefing',
            'Client Strategy Meeting',
            'Advocacy Workshop',
            'Team Roundtable',
            'Law Library Session',
            'Signing Ceremony',
            'Panel Discussion',
            'Client Welcome Lounge',
            'Research Sprint',
            'Award Recognition',
        ];

        foreach ($themes as $index => $title) {
            GalleryImage::updateOrCreate(
                ['sort_order' => $index + 1],
                [
                    'image_path' => $this->placeholderImage('seed/gallery', 'gallery-'.($index + 1), $title, 'Advocated Gallery', '#cc8356'),
                    'is_active' => true,
                ]
            );
        }
    }
}
