<?php

namespace App\Support;

/**
 * Generates placeholder app-icon SVG artwork for products created from the
 * admin dashboard — the same warm tile style as the seeded art, with the
 * product's initial as the glyph. Writes to public/images/products/{slug}.svg.
 */
class AppIcon
{
    private const PALETTES = [
        ['#f1e9db', '#e3d5bd'],
        ['#f5e6d9', '#eccfb6'],
        ['#eef0e5', '#dbe2cc'],
        ['#f4eee1', '#e9dcc5'],
    ];

    private const ACCENT = '#d97757';
    private const OCHRE = '#d4a27f';
    private const INK = '#141413';

    public static function generate(string $slug, string $name): string
    {
        [$c1, $c2] = self::PALETTES[abs(crc32($slug)) % count(self::PALETTES)];
        $letter = mb_strtoupper(mb_substr($name, 0, 1));
        $accentX = 120 + (abs(crc32($slug)) % 40);
        $accentY = 560 + (abs(crc32(strrev($slug))) % 60);

        $svg = <<<SVG
<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 800 800">
  <defs>
    <linearGradient id="bg" x1="0" y1="0" x2="1" y2="1">
      <stop offset="0" stop-color="{$c1}"/>
      <stop offset="1" stop-color="{$c2}"/>
    </linearGradient>
    <linearGradient id="tile" x1="0" y1="0" x2="1" y2="1">
      <stop offset="0" stop-color="#ffffff"/>
      <stop offset="1" stop-color="#fdf8f0"/>
    </linearGradient>
  </defs>
  <rect width="800" height="800" fill="url(#bg)"/>
  <circle cx="400" cy="400" r="252" fill="#ffffff" opacity="0.5"/>
  <path d="M122 136 l5.5 11.5 11.5 5.5 -11.5 5.5 -5.5 11.5 -5.5 -11.5 -11.5 -5.5 11.5 -5.5 z" fill="self::OCHRE"/>
  <path d="M{$accentX} {$accentY} l4 8.5 8.5 4 -8.5 4 -4 8.5 -4 -8.5 -8.5 -4 8.5 -4 z" fill="self::ACCENT"/>
  <ellipse cx="400" cy="672" rx="170" ry="20" fill="self::INK" opacity="0.08"/>
  <rect x="160" y="160" width="480" height="480" rx="104" fill="url(#tile)" stroke="self::INK" stroke-width="9"/>
  <circle cx="290" cy="262" r="14" fill="self::OCHRE"/>
  <circle cx="536" cy="566" r="11" fill="self::ACCENT"/>
  <text x="400" y="400" text-anchor="middle" dominant-baseline="central"
        font-family="Fraunces Variable, Georgia, 'Times New Roman', serif" font-weight="700" font-style="italic"
        font-size="230" fill="self::ACCENT">{$letter}</text>
</svg>
SVG;

        $svg = str_replace(
            ['self::OCHRE', 'self::ACCENT', 'self::INK'],
            [self::OCHRE, self::ACCENT, self::INK],
            $svg,
        );

        $path = public_path("images/products/{$slug}.svg");
        file_put_contents($path, $svg);

        return $path;
    }
}
