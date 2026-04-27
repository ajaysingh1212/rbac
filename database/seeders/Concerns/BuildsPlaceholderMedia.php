<?php

namespace Database\Seeders\Concerns;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

trait BuildsPlaceholderMedia
{
    protected function placeholderImage(
        string $folder,
        string $filename,
        string $title,
        string $subtitle,
        string $accent = '#c96f3b',
        string $secondary = '#0e1726'
    ): string {
        $safeFile = Str::slug($filename).'.svg';
        $path = trim($folder, '/').'/'.$safeFile;

        Storage::disk('public')->put(
            $path,
            $this->placeholderSvg($title, $subtitle, $accent, $secondary)
        );

        return $path;
    }

    protected function placeholderSvg(
        string $title,
        string $subtitle,
        string $accent,
        string $secondary
    ): string {
        $title = e(Str::upper(Str::limit($title, 32, '')));
        $subtitle = e(Str::limit($subtitle, 56, ''));

        return <<<SVG
<svg xmlns="http://www.w3.org/2000/svg" width="1600" height="1000" viewBox="0 0 1600 1000" fill="none">
  <rect width="1600" height="1000" fill="{$secondary}"/>
  <rect x="60" y="60" width="1480" height="880" rx="40" fill="url(#hero)"/>
  <circle cx="1320" cy="220" r="220" fill="{$accent}" fill-opacity="0.18"/>
  <circle cx="300" cy="780" r="260" fill="#f3d6b9" fill-opacity="0.12"/>
  <path d="M160 700C330 570 560 530 720 610C940 720 1090 540 1440 650" stroke="{$accent}" stroke-opacity="0.55" stroke-width="8" stroke-linecap="round"/>
  <path d="M160 770C380 620 610 650 790 730C980 820 1180 720 1440 760" stroke="#f8eee5" stroke-opacity="0.34" stroke-width="4" stroke-linecap="round"/>
  <rect x="170" y="190" width="250" height="12" rx="6" fill="#f8eee5" fill-opacity="0.58"/>
  <rect x="170" y="250" width="700" height="150" rx="24" fill="#0b1322" fill-opacity="0.3"/>
  <text x="170" y="360" fill="#fff4e8" font-size="92" font-weight="700" font-family="Georgia, serif">{$title}</text>
  <text x="170" y="470" fill="#f6d6ba" font-size="34" font-weight="400" font-family="Arial, sans-serif">{$subtitle}</text>
  <rect x="170" y="610" width="220" height="70" rx="35" fill="{$accent}"/>
  <text x="222" y="654" fill="#0e1726" font-size="30" font-weight="700" font-family="Arial, sans-serif">ADVOCATED</text>
  <defs>
    <linearGradient id="hero" x1="170" y1="110" x2="1420" y2="900" gradientUnits="userSpaceOnUse">
      <stop stop-color="#132238"/>
      <stop offset="1" stop-color="#1e0f0d"/>
    </linearGradient>
  </defs>
</svg>
SVG;
    }
}
