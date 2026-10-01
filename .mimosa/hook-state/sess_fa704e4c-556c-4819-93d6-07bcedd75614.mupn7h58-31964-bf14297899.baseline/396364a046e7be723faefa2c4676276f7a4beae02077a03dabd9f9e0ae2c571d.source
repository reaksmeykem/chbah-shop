<?php

namespace App\Livewire;

use App\Models\LicenseKey;
use App\Services\Analytics;
use Livewire\Component;

class LicenseCheck extends Component
{
    public string $key = '';

    public ?array $result = null;

    public function check(): void
    {
        $this->validate(
            ['key' => 'required'],
            ['key.required' => __('site.license.key_required')],
        );

        $normalized = strtoupper(preg_replace('/\s+/', '', $this->key));

        $license = LicenseKey::with('product')->where('key', $normalized)->first();

        Analytics::track('license_check', ['meta' => ['result' => $license?->status ?? 'unknown']]);

        $this->result = $license ? [
            'found' => true,
            'issued' => $license->status === 'issued',
            'product' => $license->product->name,
            'version' => $license->product->version,
            'requirements' => $license->product->requirements,
            'download' => $license->product->download_url,
            'issued_at' => $license->issued_at?->format('M j, Y'),
        ] : ['found' => false];
    }

    public function render()
    {
        return view('livewire.license-check')->title(__('site.title.license'));
    }
}
