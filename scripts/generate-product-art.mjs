/**
 * Generates the Atelier software artwork:
 *   public/images/products/*.svg   — 800×800 app-icon pieces
 *   public/images/categories/*.svg — 600×600 line icons
 *
 * Style: warm gradient ground, soft light disc, rounded app tile with a
 * charcoal line-art glyph, terracotta accent, sparkles. One file per product.
 */
import { mkdirSync, writeFileSync } from 'node:fs';
import { dirname, join } from 'node:path';
import { fileURLToPath } from 'node:url';

const root = join(dirname(fileURLToPath(import.meta.url)), '..');

const INK = '#141413';
const ACCENT = '#d97757';
const OCHRE = '#d4a27f';
const IVORY = '#faf9f5';

/* glyphs drawn inside a 400×400 box centered in the app tile */
const glyphs = {
    dramarecap: () => `
        <circle cx="200" cy="200" r="120" fill="none" stroke="${INK}" stroke-dasharray="14 22" stroke-linecap="round"/>
        <path d="M200 96 a104 104 0 1 1 -74 31" fill="none" stroke="${INK}"/>
        <path d="M126 127 l-8 -34 l34 8 z" fill="${INK}"/>
        <path d="M172 150 L262 200 L172 250 z" fill="${ACCENT}" stroke="${INK}" stroke-linejoin="round"/>`,

    pchappdf: () => `
        <path d="M118 84 h110 l52 52 v180 h-162 z" fill="${IVORY}" stroke="${INK}"/>
        <path d="M228 84 v52 h52" fill="none" stroke="${INK}"/>
        <path d="M142 176 h64 M142 204 h84 M142 232 h50" stroke="${INK}" opacity="0.65"/>
        <rect x="196" y="248" width="128" height="96" rx="18" fill="${ACCENT}" stroke="${INK}"/>
        <path d="M260 268 v56 M232 296 h56" stroke="${IVORY}" stroke-width="12" stroke-linecap="round"/>`,

    'chbah-voice': () => `
        <rect x="178" y="86" width="44" height="118" rx="22" fill="${ACCENT}" stroke="${INK}"/>
        <path d="M142 178 a58 58 0 0 0 116 0" fill="none" stroke="${INK}"/>
        <path d="M200 236 v44 M164 280 h72" stroke="${INK}"/>
        <path d="M118 150 c-12 30 -12 50 0 80 M282 150 c12 30 12 50 0 80" fill="none" stroke="${OCHRE}" opacity="0.9"/>
        <path d="M92 130 c-18 42 -18 78 0 120 M308 130 c18 42 18 78 0 120" fill="none" stroke="${OCHRE}" opacity="0.55"/>`,

    'chbah-cam': () => `
        <rect x="140" y="66" width="120" height="230" rx="28" fill="${IVORY}" stroke="${INK}"/>
        <circle cx="200" cy="104" r="8" fill="${INK}"/>
        <circle cx="200" cy="180" r="42" fill="${ACCENT}" stroke="${INK}"/>
        <circle cx="200" cy="180" r="18" fill="${IVORY}" stroke="${INK}"/>
        <path d="M286 138 a86 86 0 0 1 0 124 M316 116 a124 124 0 0 1 0 168"
              fill="none" stroke="${OCHRE}" stroke-linecap="round"/>
        <path d="M170 262 h60" stroke="${INK}" opacity="0.5"/>`,
};

/* category icons drawn in a 400×400 box */
const categoryGlyphs = {
    video: () => `
        <rect x="84" y="118" width="196" height="164" rx="28" fill="#fff" stroke="${INK}"/>
        <path d="M160 160 L226 200 L160 240 z" fill="${ACCENT}" stroke="${INK}" stroke-linejoin="round"/>
        <path d="M312 160 L312 240 L262 200 z" fill="#fff" stroke="${INK}" stroke-linejoin="round"/>`,

    pdf: () => `
        <path d="M118 84 h110 l52 52 v180 h-162 z" fill="#fff" stroke="${INK}"/>
        <path d="M228 84 v52 h52" fill="none" stroke="${INK}"/>
        <path d="M142 176 h64 M142 204 h84" stroke="${INK}" opacity="0.65"/>
        <path d="M148 262 h96" stroke="${ACCENT}" stroke-width="12" stroke-linecap="round"/>`,

    audio: () => `
        <rect x="178" y="86" width="44" height="118" rx="22" fill="#fff" stroke="${INK}"/>
        <path d="M142 178 a58 58 0 0 0 116 0" fill="none" stroke="${INK}"/>
        <path d="M200 236 v44 M164 280 h72" stroke="${INK}"/>
        <path d="M118 150 c-12 30 -12 50 0 80 M282 150 c12 30 12 50 0 80" fill="none" stroke="${ACCENT}"/>`,

    camera: () => `
        <rect x="140" y="66" width="120" height="230" rx="28" fill="#fff" stroke="${INK}"/>
        <circle cx="200" cy="180" r="42" fill="#fff" stroke="${INK}"/>
        <circle cx="200" cy="180" r="18" fill="${ACCENT}"/>
        <path d="M286 138 a86 86 0 0 1 0 124" fill="none" stroke="${INK}"/>`,
};

/* product slug → glyph + background palette index */
const products = [
    ['dramarecap', 'dramarecap', 0],
    ['pchappdf', 'pchappdf', 1],
    ['chbah-voice', 'chbah-voice', 2],
    ['chbah-cam', 'chbah-cam', 3],
];

const palettes = [
    ['#f1e9db', '#e3d5bd'],
    ['#f5e6d9', '#eccfb6'],
    ['#eef0e5', '#dbe2cc'],
    ['#f4eee1', '#e9dcc5'],
];

const sparkle = (x, y, s, fill) => `
    <path d="M${x} ${y - s} L${x + s * 0.32} ${y - s * 0.32} L${x + s} ${y} L${x + s * 0.32} ${y + s * 0.32}
             L${x} ${y + s} L${x - s * 0.32} ${y + s * 0.32} L${x - s} ${y} L${x - s * 0.32} ${y - s * 0.32} z"
          fill="${fill}"/>`;

function productSvg(slug, glyphKey, paletteIdx) {
    const [c1, c2] = palettes[paletteIdx];

    return `<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 800 800">
  <defs>
    <linearGradient id="bg" x1="0" y1="0" x2="1" y2="1">
      <stop offset="0" stop-color="${c1}"/>
      <stop offset="1" stop-color="${c2}"/>
    </linearGradient>
    <linearGradient id="tile" x1="0" y1="0" x2="1" y2="1">
      <stop offset="0" stop-color="#ffffff"/>
      <stop offset="1" stop-color="#fdf8f0"/>
    </linearGradient>
  </defs>
  <rect width="800" height="800" fill="url(#bg)"/>
  <circle cx="400" cy="400" r="252" fill="#ffffff" opacity="0.5"/>
  ${sparkle(122, 136, 16, OCHRE)}
  ${sparkle(686, 190, 12, ACCENT)}
  ${sparkle(660, 642, 10, OCHRE)}
  <ellipse cx="400" cy="672" rx="170" ry="20" fill="${INK}" opacity="0.08"/>
  <rect x="160" y="160" width="480" height="480" rx="104" fill="url(#tile)" stroke="${INK}" stroke-width="9"/>
  <g transform="translate(200 200) scale(1)" fill="none" stroke="${INK}" stroke-width="9"
     stroke-linecap="round" stroke-linejoin="round">
    ${glyphs[glyphKey]()}
  </g>
</svg>
`;
}

function categorySvg(glyphKey) {
    return `<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 600 600">
  <circle cx="300" cy="300" r="252" fill="#ffffff" opacity="0.6"/>
  <g transform="translate(100 100) scale(1)" fill="none" stroke="${INK}" stroke-width="9"
     stroke-linecap="round" stroke-linejoin="round">
    ${categoryGlyphs[glyphKey]()}
  </g>
</svg>
`;
}

const productDir = join(root, 'public', 'images', 'products');
const categoryDir = join(root, 'public', 'images', 'categories');
mkdirSync(productDir, { recursive: true });
mkdirSync(categoryDir, { recursive: true });

for (const [slug, glyph, pal] of products) {
    writeFileSync(join(productDir, `${slug}.svg`), productSvg(slug, glyph, pal));
}

const categories = { 'video-tools': 'video', 'pdf-tools': 'pdf', 'audio-tools': 'audio', 'camera-tools': 'camera' };
for (const [slug, glyph] of Object.entries(categories)) {
    writeFileSync(join(categoryDir, `${slug}.svg`), categorySvg(glyph));
}

console.log(`artwork: ${products.length} products + ${Object.keys(categories).length} categories`);
