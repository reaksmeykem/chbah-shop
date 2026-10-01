<?php

namespace App\Services;

use App\Models\AnalyticsEvent;
use Illuminate\Http\Request;

/**
 * First-party, consent-gated analytics.
 *
 * Nothing is written unless the visitor chose "Accept all" (cookie
 * `chbah_consent=all`). Visitors are identified by an HMAC of their
 * session id — never stored raw, no IP address is recorded.
 */
class Analytics
{
    public const CONSENT_COOKIE = 'chbah_consent';

    public const EVENTS = ['page_view', 'product_viewed', 'add_to_cart', 'purchase', 'search', 'license_check'];

    public static function consented(): bool
    {
        return app(Request::class)->cookie(self::CONSENT_COOKIE) === 'all';
    }

    public static function track(string $event, array $data = []): void
    {
        if (! in_array($event, self::EVENTS, true) || ! self::consented()) {
            return;
        }

        $request = app(Request::class);
        $agent = (string) $request->userAgent();
        $sessionId = $request->hasSession() ? $request->session()->getId() : '';

        AnalyticsEvent::create([
            'session_hash' => hash_hmac('sha256', $sessionId, (string) config('app.key')),
            'event' => $event,
            'url' => isset($data['url']) ? mb_substr($data['url'], 0, 255) : null,
            'referrer' => $request->header('referer') ? mb_substr((string) $request->header('referer'), 0, 255) : null,
            'product_id' => $data['product_id'] ?? null,
            'search_term' => isset($data['search']) ? mb_substr($data['search'], 0, 120) : null,
            'meta' => $data['meta'] ?? null,
            'device' => self::device($agent),
            'browser' => self::browser($agent),
            'platform' => self::platform($agent),
            'locale' => app()->getLocale(),
            'created_at' => now(),
        ]);
    }

    public static function device(string $agent): string
    {
        return match (true) {
            preg_match('/bot|crawl|spider|slurp|bingpreview/i', $agent) === 1 => 'bot',
            preg_match('/iPad|Tablet|PlayBook|Silk/i', $agent) === 1 => 'tablet',
            preg_match('/Mobi|iPhone|Android.*Mobile|Windows Phone/i', $agent) === 1 => 'mobile',
            default => 'desktop',
        };
    }

    public static function browser(string $agent): string
    {
        return match (true) {
            preg_match('/Edg(?:e|A|iOS)?\//i', $agent) === 1 => 'Edge',
            preg_match('/OPR\/|Opera/i', $agent) === 1 => 'Opera',
            preg_match('/Firefox|FxiOS/i', $agent) === 1 => 'Firefox',
            preg_match('/Chrome|CriOS/i', $agent) === 1 => 'Chrome',
            preg_match('/Safari/i', $agent) === 1 => 'Safari',
            default => 'Other',
        };
    }

    public static function platform(string $agent): string
    {
        return match (true) {
            preg_match('/Windows/i', $agent) === 1 => 'Windows',
            preg_match('/Android/i', $agent) === 1 => 'Android',
            preg_match('/iPhone|iPad|iPod|iOS/i', $agent) === 1 => 'iOS',
            preg_match('/Mac OS X|Macintosh/i', $agent) === 1 => 'macOS',
            preg_match('/Linux/i', $agent) === 1 => 'Linux',
            default => 'Other',
        };
    }
}
