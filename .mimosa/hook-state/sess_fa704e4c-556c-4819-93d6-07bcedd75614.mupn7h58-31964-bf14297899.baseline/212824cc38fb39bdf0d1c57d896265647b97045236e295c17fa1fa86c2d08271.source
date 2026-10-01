<?php

namespace App\Http\Controllers;

use App\Services\Analytics;
use Illuminate\Http\Request;

class AnalyticsController extends Controller
{
    public function track(Request $request)
    {
        $data = $request->validate([
            'event' => 'required|in:page_view',
            'url' => 'nullable|string|max:255',
        ]);

        Analytics::track($data['event'], ['url' => $data['url'] ?? null]);

        return response()->noContent();
    }
}
