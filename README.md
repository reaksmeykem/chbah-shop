<p align="center"><strong>Chbah</strong> — a TALL-stack software shop with Claude-inspired styling</p>

---

A storefront for selling **your own Windows software** (DramaRecap, PchapPDF, Chbah Voice, Chbah Cam), built with the **TALL stack** (Tailwind CSS, Alpine.js, Laravel, Livewire) and styled after [claude.ai](https://claude.ai): ivory paper surfaces, cream panels, ink typography, terracotta accent. Ambient background animation (floating orbs + film grain), a Three.js 3D hero, and 3D tilt cards.

## The shop flow

1. Customer browses software (categories: Video / PDF / Audio / Camera tools), each product page shows features, version, requirements and a trial download link
2. Add to cart → enter email → **checkout issues real license keys** from the key stock (`license_keys` table, transactional — never oversells)
3. Keys are shown in the panel with copy buttons; orders + items are stored
4. Anyone can verify a key anytime at **/license** — product, version, issue date (this is the same lookup an app's activation form can call)

> Checkout is intentionally payment-less (demo): order is marked `paid` instantly. Wire a payment provider into `CartPanel::checkout()` for production.

## The software catalog

| Product | What it does | Price |
|---|---|---|
| **DramaRecap** | Turns long drama episodes into tight recaps — scene detection, subtitle-aware trimming, batch export | $24 |
| **PchapPDF** | Merge/combine PDFs via right-click in Explorer or a drag-and-drop window. 100% offline | $12 |
| **Chbah Voice** | Real-time voice cleaning (< 20 ms) for livestreams and calls, installs as a virtual mic | $18 |
| **Chbah Cam** | Use a smartphone as a native Windows webcam — 4K over USB, Wi-Fi, auto color correction | $15 |

Each product ships with 40 seeded license keys (prefixes `DRMR` / `PCPD` / `CHVC` / `CHCM`).

## Requirements

- PHP 8.2+ with `pdo_sqlite`, `sqlite3`, `mbstring`, `openssl`, `curl`, `dom`, `zip`, `intl`, `gd`
- Composer 2, Node 18+

> **Note (this machine):** a portable PHP 8.4 + Composer toolchain lives in `.tools/` —
> `D:/2026/MyProjects/.tools/php/php.exe` + `.tools/composer.phar`. Add `.tools/php` to PATH and everything below works as-is.

## Run it

```bash
cd atelier

composer install
npm install

php artisan migrate:fresh --seed   # 4 products + 160 license keys
npm run build                      # or: npm run dev (hot reload)

php artisan serve --host=127.0.0.1 --port=8080   # port 8000 is reserved on this machine
```

Open **http://127.0.0.1:8080**

| Route | Purpose |
|---|---|
| `/` | Home — 3D hero, tool categories, latest releases |
| `/shop` | Catalog — live search, category chips, sorting, pagination |
| `/product/{slug}` | Product detail — features, version, requirements, trial download |
| `/license` | License key lookup |
| `/about` | About the studio, its tools and values |
| `/terms` | Terms of Service (8 sections, bilingual) |
| `/privacy` | Privacy Policy (documents the consent-gated analytics) |
| `/locale/{en\|km}` | Switch language (also via the navbar EN/ខ្មែរ toggle) |
| `/admin` | **Owner dashboard** — password: `ADMIN_PASSWORD` in `.env` (default `atelier-admin`) |

## Customer support (Telegram)

A floating help widget (bottom-right, chat bubble with a soft ping) expands to **Chat on Telegram** and **Email us**. The channels come from `.env` — point them at your real accounts:

```
SUPPORT_TELEGRAM_URL=https://t.me/your_handle
SUPPORT_EMAIL=you@example.com
```

The same links appear on the About page, at the end of the Terms/Privacy pages, and in the privacy-policy contact section. To swap Telegram for another channel (WhatsApp, Messenger…), change the link in `.env` and the label/icon in `resources/views/components/support-widget.blade.php`.

## Cookie consent & analytics

The storefront shows a bilingual consent banner (bottom-right) until the visitor picks **Accept all** or **Essential only** — the choice is stored in the `atelier_consent` cookie for a year.

Analytics are **first-party and consent-gated**:

- Events land in the `analytics_events` table on your own server. Tracked: page views (including Livewire navigations), product views, searches, add-to-cart, purchases (with total), and license-key lookups.
- Visitors are pseudonymous — an HMAC of the session id. **No IP addresses, no names, no third-party scripts.**
- Nothing is written before consent; "Essential only" disables all recording.
- The admin **Analytics** page (`/admin/analytics`) charts views per day and ranks top pages, products viewed, search terms, referrers, browsers/platforms/devices/languages. Range switch: 7 / 14 / 30 days.

Wire a real product-analytics tool (e.g. Plausible/Matomo) later by swapping the `track()` call in `resources/js/analytics.js` — the consent gate already does the compliance part.

## Admin dashboard (/admin)

Password-protected (single shared password, `ADMIN_PASSWORD` in `.env` — demo-grade auth; swap for user accounts when needed). Also linked discreetly in the storefront footer.

- **Dashboard** — products, key stock, issued keys, revenue, recent orders
- **Products** — create / edit / delete (delete cascades to that product's keys), featured toggle, search
- **Product form** — name, slug (auto), category, tagline, description, price, version, key prefix, badge, requirements, download URL, features (one per line), and optional auto-generated app-icon artwork (SVG written to `public/images/products/{slug}.svg`)
- **License keys** — per-product available/issued counts, mint +10 / +50 keys on demand
- **Orders** — every order with items and the exact license keys delivered

## Languages (English + Khmer)

The whole UI is translated — nav, footer, home, shop, product pages, cart/checkout, license lookup — via `lang/en/*` and `lang/km/*`. Product and category text is translated too (`lang/{locale}/products.php`, `categories.php`, keyed by slug; falls back to the English database columns when a key is missing).

The navbar has an **EN / ខ្មែរ** toggle (persisted in the session). The Khmer locale swaps the font stack to **Noto Sans Khmer** (self-hosted) with adjusted line-height/tracking, since Fraunces/Inter have no Khmer glyphs. Khmer strings live in `lang/km/` — edit them there to refine wording.

## Project map

```
app/Livewire/            Home, ProductCatalog, ProductDetail, CartPanel (checkout), CartBadge, LicenseCheck
app/Services/Cart.php    session-backed cart
app/Http/Middleware/SetLocale.php   per-session locale (en | km)
app/Models/              Product, Category, LicenseKey, Order, OrderItem
lang/en, lang/km         translations: site, products, categories
resources/css/app.css    design tokens (@theme), orbs/grain/marquee/tilt/reveal animations, km font overrides
resources/js/three-hero.js   Three.js hero scene (transparent canvas, idle rotation + parallax)
resources/js/tilt.js     pointer-tracked 3D tilt for [data-tilt] cards
resources/js/reveal.js   IntersectionObserver scroll reveal (re-scans after Livewire updates)
resources/views/layouts/app.blade.php   shell: glass nav, language switcher, footer, cart mount
database/seeders/        4 software products + 160 license keys
public/images/products/  generated app-icon SVG artwork (node scripts/generate-product-art.mjs)
```

## Design tokens (sampled from claude.ai)

| Token | Value | Use |
|---|---|---|
| `ivory` | `#faf9f5` | page background (claude.ai theme: `#fcfcfb`) |
| `cream` | `#f0eee6` | panels, frames |
| `ink` | `#141413` | text (anthropic.com theme-color) |
| `accent` | `#d97757` | terracotta — buttons, highlights |
| `sage` / `ochre` | `#a3b295` / `#d4a27f` | supporting palette |

Fonts: **Fraunces Variable** (serif display) + **Inter Variable** (UI), self-hosted via Fontsource.

## Notes

- `prefers-reduced-motion` disables all ambient animation.
- Regenerate artwork anytime: `node scripts/generate-product-art.mjs`.
- Natural next steps: a payment provider in `checkout()`, an admin panel for products/keys, license-activation API endpoint for the apps themselves.
