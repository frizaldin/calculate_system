<?php

namespace App\View\Components\Nav\Sidebar;

use App\Models\Feature;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Menu extends Component
{
    /**
     * Create a new component instance.
     */
    public $url;
    public $key;
    public $icon;
    public $authority;

    public function __construct($url, $key, $authority, $icon = "")
    {
        $this->url = $url;
        $this->key = $key;
        $this->icon = $icon;
        $this->authority = $authority;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.nav.sidebar.menu', [
            'feature' => Feature::where('code', $this->key)->get(),
        ]);
    }
}
