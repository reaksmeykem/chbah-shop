<?php

namespace App\Livewire\Admin;

use App\Models\AnalyticsEvent;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Analytics — Chbah Admin')]
class Analytics extends Component
{
    public int $days = 14;

    public function render()
    {
        $since = now()->subDays($this->days - 1)->startOfDay();

        $visitsByDay = AnalyticsEvent::query()
            ->where('event', 'page_view')
            ->where('created_at', '>=', $since)
            ->selectRaw('DATE(created_at) as d, COUNT(*) as c')
            ->groupBy('d')
            ->pluck('c', 'd');

        $chart = collect(range($this->days - 1, 0))->map(function ($i) use ($visitsByDay) {
            $day = now()->subDays($i)->startOfDay();

            return [
                'label' => $day->format('M j'),
                'count' => (int) ($visitsByDay[$day->format('Y-m-d')] ?? 0),
            ];
        });
        $max = max(1, $chart->max('count'));

        $top = fn (string $event, ?string $group, int $limit = 6) => AnalyticsEvent::query()
            ->where('event', $event)
            ->when($group, fn ($q) => $q->whereNotNull($group)->where($group, '!=', ''))
            ->where('created_at', '>=', $since)
            ->selectRaw(($group ?? "'*'") . ' as label, COUNT(*) as c')
            ->groupBy($group ?? 'event')
            ->orderByDesc('c')
            ->limit($limit)
            ->pluck('c', 'label');

        $topProducts = AnalyticsEvent::query()
            ->where('event', 'product_viewed')
            ->where('analytics_events.created_at', '>=', $since)
            ->join('products', 'products.id', '=', 'analytics_events.product_id')
            ->selectRaw('products.name as label, COUNT(*) as c')
            ->groupBy('products.name')
            ->orderByDesc('c')
            ->limit(6)
            ->pluck('c', 'label');

        return view('admin.analytics', [
            'chart' => $chart,
            'max' => $max,
            'visits' => $chart->sum('count'),
            'uniques' => AnalyticsEvent::where('event', 'page_view')->where('created_at', '>=', $since)->distinct('session_hash')->count('session_hash'),
            'productViews' => AnalyticsEvent::where('event', 'product_viewed')->where('created_at', '>=', $since)->count(),
            'cartAdds' => AnalyticsEvent::where('event', 'add_to_cart')->where('created_at', '>=', $since)->count(),
            'purchases' => AnalyticsEvent::where('event', 'purchase')->where('created_at', '>=', $since)->count(),
            'topPages' => $top('page_view', 'url', 8),
            'topSearches' => $top('search', 'search_term', 8),
            'topProducts' => $topProducts,
            'browsers' => $top('page_view', 'browser', 5),
            'platforms' => $top('page_view', 'platform', 5),
            'devices' => $top('page_view', 'device', 5),
            'locales' => $top('page_view', 'locale', 5),
            'referrers' => $top('page_view', 'referrer', 5),
        ])->layout('layouts.admin');
    }
}
