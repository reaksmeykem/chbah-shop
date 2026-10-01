<?php

namespace App\Livewire;

use Livewire\Component;

class InfoPage extends Component
{
    public string $page = 'about';

    public function mount(string $page): void
    {
        abort_unless(in_array($page, ['about', 'terms', 'privacy'], true), 404);

        $this->page = $page;
    }

    public function render()
    {
        return view('livewire.info-page', [
            'doc' => $this->page !== 'about' ? __('site.' . $this->page) : null,
        ])->title(__('site.title.' . $this->page));
    }
}
